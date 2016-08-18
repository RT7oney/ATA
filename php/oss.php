'<?php
use Workerman\Worker;
use OSS\OssClient;
use OSS\Core\OssException;

require_once './Workerman/Autoloader.php';
require_once './common/common.php';
require_once './common/aliyun-oss/autoload.php';

/*
 * oss上传实例
 * 所需参数
 * file  文件数据流
 * file_name  文件名称
 */

$tcp_worker = new Worker("File://0.0.0.0:10200");


$tcp_worker->count = 4;


$tcp_worker->onMessage = function ($connection, $data) {
    global $_SG , $_SC;
    $data = json_decode($data, true);
    if ($data) {
        $file = base64_decode($data['file']);//数据流
        $file_name = $data['file_name'];//文件名称
        if(imagecreatefromstring($file)!==false) {//判断是否为二进制图片
            $tmp_arr = explode('.',$file_name);//以 . 拆分文件名为数组
            $type = array_pop($tmp_arr);//获取数组最后一位 获取文件类型
            $object = 'merchant_news/'.date('Y/m').'/'.time().uniqid(rand(1000,9999)).'.'.$type;//拼接需要存放在oss路径 带文件名
            echo $object."\n";
            echo $_SC['merchant_bucket'];
            $ossClient = new OssClient($_SC['accessKeyId'], $_SC['accessKeySecret'], $_SC['endpoint'],false);//实例化的oss对象
            $result= oss_upload($ossClient,$_SC['merchant_bucket'],$object,$file);//$_SC['merchant_bucket'] 是oss商户的空间
            if($result){
                $msg = array('code' => 10200001, 'msg' => '成功');
            }else{
                $msg = array('code' => 10200002, 'msg' => '图片上传失败');
            }
        }else{
            $msg = array('code'=>10200003,'msg'=>'不是一张正常的图片');
        }
    }else{
        $msg = array('code'=>10200004,'msg'=>'参数不合法');
    }
    $connection->send(json_encode($msg));
    $connection->close();
};


Worker::$stdoutFile = '/var/log/workerman/10200-' . date('Ym') . '.log';
// 运行worker
Worker::runAll();

//判断商户是否存在
function merchants_is_exist($merchant_id){
    global $_SG;
    $sql = "select * from merchant_infos where id = '".$merchant_id."' limit 1";
    $row = $_SG['db']->find($sql);
    if(count($row) > 0 && is_array($row)){
        return $row;
    }else{
        return false;
    }
}

//上传文件
function oss_upload($ossClient,$bucket, $object, $file){
    $doesExist = $ossClient->doesBucketExist($bucket);
    if(!$doesExist){
        $client =$ossClient->createBucket($bucket);
    }
    try{
        $ossClient->putObject($bucket, $object, $file);
        return true;
    } catch (OssException $e){
        return false;
    }
}
/**
 * 设置bucket的acl配置
 *
 * @param OssClient $ossClient OssClient实例
 * @param string $bucket 存储空间名称
 * @return null
 */
function putBucketAcl($ossClient, $bucket)
{
    $acl = OssClient::OSS_ACL_TYPE_PUBLIC_READ;
    try {
        $ossClient->putBucketAcl($bucket, $acl);
    } catch (OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");
        return;
    }
    print(__FUNCTION__ . ": OK" . "\n");
}