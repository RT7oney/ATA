<?php
echo date("Y-m-d H:i:s", time());
 ?>
下载图片方法1
// $ch = curl_init ();
// curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
// curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
// curl_setopt ( $ch, CURLOPT_URL, $url );
// ob_start ();
// curl_exec ( $ch );
// $return_content = ob_get_contents ();
// ob_end_clean ();

// $imageData = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
下载图片方法2
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$imageData = curl_exec($curl);
curl_close($curl);
下载图片方法3
// ob_start();
// readfile($url);
// $imageData=ob_get_contents();
// ob_end_clean();
=============================================
function common_download_img($url){
  ob_start();
  readfile($url);
  $imageData=ob_get_contents();
  ob_end_clean();
  print_r($imageData);die;

  $filename = date("Ymdhis").".jpg";
  $tp = @fopen($filename, 'a');
  // print_r($tp);die;
  fwrite($tp, $imageData);
  // echo $tp;
  fclose($tp);

  // $file = file_get_contents($url);
  // echo $file;die;
  // header ("Content-type: octet/stream");
  // header ("Content-disposition: attachment; filename=".$file.";");
  // header("Content-Length: ".filesize($file));
  // readfile($file);
}
