<?php
$agent = @$_SERVER['HTTP_USER_AGENT'];
$uri = @$_SERVER['REQUEST_URI'];
$ip = @$_SERVER['REMOTE_ADDR'];
$ref = @$_SERVER['HTTP_REFERER'];
$proxy = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$via = @$_SERVER['HTTP_VIA'];
$dtime = date('r');
$info = "working well";
$fp = fopen("logging.txt", "a") or die('Can\'t create file');;
fputs($fp, $info."|".$dtime."|".$ip."|".$agent."|".$uri."|".$ref."|".$proxy."|".$via."\r\n");
fclose($fp);
?>