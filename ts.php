<?php
error_reporting(0);
header("content-type: video/mp2t");
header("pragma: no-cache");
$ts = $_GET['ts'];
$tok=file_get_contents("tokenx.txt");
$pxy = "";
$url = $ts."?".$tok;
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: exoplayer\r\n"
  )
);
$context = stream_context_create($opts);
$e = file_get_contents($url, false, $context);
echo $e;
?>