<?php
error_reporting(0);
header("content-type: application/vnd.apple.mpegurl");
header("pragma: no-cache");
header("Connection: keep-alive");
$id = $_GET['id'];
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: REDLINECLIENT RED360 V0.1.49" 
    ]
];

$cx = stream_context_create($opts);

$json = json_decode(file_get_contents("star.json"), true);

foreach($json["channels_list"] as $v) {
	if($v['id'] == $id) {
		$url = $v['link'];
	}
}

$tok=file_get_contents("tokenx.txt");
$burl = $url;
$pxy="";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $burl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$html = curl_exec($ch);
$baselink = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
curl_close($ch);
$burl = $pxy.$baselink;
$blink = preg_replace("/(?=index).*/", "", $burl);
$elink = preg_replace("/(?=index).*/", "", $baselink);
$flink = $blink."tracks-v1a1/mono.m3u8?".$tok;
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: REDLINECLIENT POCO M2004J19PI 1.0.02"
  )
);
$context = stream_context_create($opts);
$e = file_get_contents($flink, false, $context);
header("User-Agent: REDLINECLIENT POCO M2004J19PI 1.0.02");
$f = preg_replace("/(?<=ts).*/", "", $e);
$g = preg_replace("/(?=2022\/).*ts/", "ts.php?ts=".$elink."tracks-v1a1/"."$0", $f);

if(strpos($g, "EXTM3U") !== false) {
echo $g;
} else {
$retry = "star7.php?id=".$id."&e=.m3u8";
header("Location: ".$retry);
}
?>