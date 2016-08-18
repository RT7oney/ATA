<?php


/**
 * 返回操作结果集,包含状态码,响应消息和响应数据.
 *
 * @param string / int $status
 * @param null $data
 *
 * @return \Core\Models\Status
 *
 */
function status($status, $data = null)
{
    return \Core\Services\Status::make($status, $data);
}

/**
 * 获取响应消息
 *
 * @param string $message
 *
 * @return string
 */
function message($message)
{
    return trans("messages.$message");
}

/**
 * 响应异常状态操作
 *
 *
 * @param array $status
 * @param mixed $data
 *
 * @throws \Core\Exceptions\StatusException
 */
function exception($status, $data = null)
{
    throw new \Core\Exceptions\StatusException(status($status, $data));
}

/**
 *
 * 获取本地化文件名称属性
 *
 * @param $ident
 *
 * @return null|string
 */
function trans_name($ident)
{
    $item = trans($ident);

    if (is_array($item)) {

        return isset($item['name']) ? $item['name'] : null;
    }

    return $item;
}


/**
 * 调试打印函数
 *
 * @param mixed $var
 */
function d($var)
{
    die(json_encode($var));
}


/**
 * 生成插件和主题静态资源链接
 *
 * @param atring $path
 */
function asset($path)
{
    d(__DIR__);
}

/**
 * 接口权限验证函数
 *
 * @param $permission
 * @param $resource
 * @param $user_id
 * @param $callback
 */
function auth($permission, $resource, $user_id, $callback)
{

}

/**
 * 注册钩子全局对象
 */

global $hook;

$hook = new \Core\Services\Hook();


/**
 * 生成权限校验对象
 *
 * @return Rbac
 */
function rabc()
{
    return new \Core\Services\Rbac();
}

/**
 * 绑定钩子函数
 *
 * @param $tag
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 */
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1)
{

    global $hook;

    $hook->add_action($tag, $function_to_add, $priority, $accepted_args);
}

/**
 * 触发钩子函数
 *
 * @param $tag
 * @param string $arg
 */
function do_action($tag, $arg = '')
{

    global $hook;

    $hook->do_action($tag, $arg);
}


/**
 * 获取GET参数
 *
 * @param null $key
 *
 * @return null
 */
function get_query($key = null)
{
    if ($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    return $_GET;
}

/**
 * 加载样式文件
 *
 * @param $path
 */
function load_plugin_style($path)
{
    echo '<link rel="stylesheet" type="text/css" href="/content/plugins/' . $path . '" />';
}

/**
 * 加载脚本文件
 *
 * @param $path
 */
function load_plugin_script($path)
{
    echo '<script type="text/javascript" src="/content/plugins/' . $path . '"></scripts>';
}

/**
 * 遍历目录获取子文件
 *
 * @param string $dir 遍历目标目录路径
 *
 * @return array
 */
function list_files($dir)
{
    $files = array();

    if (is_dir($dir)) {

        if ($handler = opendir($dir)) {

            while (($file = readdir($handler)) !== false) {

                $path = $dir . "/" . $file;

                if ((is_file($path)) && $file != "." && $file != "..") {

                    array_push($files, $path);
                }
            }
            closedir($handler);
        }
    }

    return $files;
}


/**
 * 遍历目录获取子目录
 *
 * @param string $dir 遍历目标目录路径
 * @param bool $all 是否递归遍历
 *
 * @return array
 */
function list_dirs($dir, $all = false)
{
    $dirs = array();

    if (is_dir($dir)) {

        if ($handler = opendir($dir)) {

            while (($file = readdir($handler)) !== false) {

                $path = $dir . "/" . $file;

                if ((is_dir($path)) && $file != "." && $file != "..") {

                    array_push($dirs, $path);

                    if ($all) {
                        list_dirs("$path/");
                    }
                }
            }
            closedir($handler);
        }
    }

    return $dirs;
}

/**
 * 生成唯一标识符
 *
 * @return string
 */
function id()
{
    return md5(sha1(uniqid(mt_rand(1, 1000000))));
}

/**
 * 数据验证函数
 *
 * @param array $data 验证数据
 * @param array $rule 验证规则
 *
 * @return bool
 */
function validate(array $data, array $rule)
{
    $validator = \Illuminate\Support\Facades\Validator::make($data, $rule);

    if ($validator->fails()) {

        return $validator->errors();
    }

    return true;
}

/**
 * 获取资源的数据表名
 *
 * @param null $name 指定表明
 *
 * @return DB
 */
function table($name)
{
    return \Illuminate\Support\Facades\DB::table($name);
}

/**
 * 资源查询构造器.
 *
 * 支持`order`,`offset`,`limit`,`fields`,`group`,`count`,`first`等条件筛选.
 *
 *
 * @param string $table 数据表名称
 * @param array $params 查询参数
 *
 * @return mixed 数据库查询结果
 *
 */
function selector($table, array $params = [])
{
    $query = table($table);

    foreach ($params as $action => $param) {

        switch ($action) {
            case 'order':
                $options = explode(':', $param);
                $query = $query->orderBy($options[0], $options[1]);
                break;
            case 'offset':
                $query = $query->skip($param);
                break;
            case 'limit':
                $query = $query->take($param);
                break;
            case 'fields':
                $query = $query->lists($param);
                break;
            case 'group':
                $query = $query->groupBy($param);
                break;
            case 'count':
            case 'first':
                break;
            default:
                $query = $query->where($action, $param);

        }
    }

    return isset($params['count']) ? $data = $query->count() : $data = $query->get();
}

/**
 * 过滤掉数据的多余字段.
 *
 * @param  array $data
 * @param  array $fields
 * @param  array $ignore
 *
 * @throws \Core\Exceptions\StatusException
 */
function fields_filter(array &$data, array $fields, array $ignore = [])
{
    $fields = array_diff($fields, $ignore);

    foreach ($data as $k => $v) {

        if (!in_array($k, $fields)) {

            unset($data[$k]);
        }

    }

    if (!$data) {

        exception('InvalidData');
    }

}

/**
 * 数据库事务处理
 *
 * 在闭包函数中使用`DB`或`Eloquent`作数据库,监听闭包函数异常,操作数据库事务.
 *
 * @param $callback
 * @return mixed 闭包函数的返回结果,或者是操作事务操作失败信息(1003)
 *
 * @throws \Exception
 */
function transaction($callback)
{
    DB::beginTransaction();

    try {

        $status = $callback($this);

        DB::commit();

    } catch (\Exception $error) {

        DB::rollBack();

        throw $error;
    }

    return $status;
}

/**
 * 获取日期时间戳
 *
 * @return string
 */
function timestamp()
{
    return date('Y-m-d H:i:s');
}
