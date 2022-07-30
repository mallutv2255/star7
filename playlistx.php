<?php
header("Content-Type: application/vnd.apple.mpegurl");
echo '#EXTM3U x-tvg-url="https://github.com/mitthu786/tvepg/releases/download/latest/epg.xml.gz"' . PHP_EOL;
echo "" . PHP_EOL;
$json = json_decode(file_get_contents('star.json') , true);

foreach($json["channels_list"] as $v)
{

    printf("#EXTINF:-1 tvg-id=\"%u\" group-title=\"%s\" tvg-language=\"%s\" tvg-logo=\"%s\",%s" . PHP_EOL, $v['id'], $v['category'], $v['language'], $v['logo'], $v['name']);
    
    printf("http://hotstarx.herokuapp.com/telegram_iamsom5/star7.php?id=%s" . PHP_EOL . PHP_EOL, $v['id']);
    
}

?>
