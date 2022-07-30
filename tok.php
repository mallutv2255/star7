<?php
//set_time_limit(300);
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: REDLINECLIENT vivo vivo 1724 1.0.02" 
    ]
];

$cx = stream_context_create($opts);
//$rey="aHR0cDovL3JleWFuY2UwLndlYmQucHJvL21wLnBocC8=";
//$pxy= base64_decode($rey);
$url = ("https://android.rediptv2.com/ch.php?usercode=8165709339&pid=1&mac=B89BED022CDF&sn=24f1ce62&customer=vivo&lang=eng&cs=amlogic&check=1455479032");
$a = file_get_contents($url,false,$cx);
$json = json_decode($a, true);
foreach($json as $values) {
    if ($values['id'] == '18184') {
        $base = $values['link'];
        $preg = preg_match("/token=.*"."/", $base, $match);
        $tok = str_replace("RED", "RED", $match[0]);
		//$maintoken=base64_encode($tok);
        echo $tok;
        //file_put_contents("/to.txt", $maintoken);
    }
}
file_put_contents("tokenx.txt", $tok);

?>