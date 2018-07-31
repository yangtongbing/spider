<?php
require_once './vendor/autoload.php';

header('Content-Type:text/html;charset=utf8');
$url = "http://china.baixing.com/jinrongfuwu/?page=2";
$html = \phpspider\core\requests::get($url);

// 选择器规则
$selector = "//ul[contains(@class,'list-ad-items')]//li/div/div[0]/span/button/@data-contact";
// 提取结果
$result = \phpspider\core\selector::select($html, $selector);
if ($result) {
    $temp = [];
    foreach ($result as $value) {
        if ($i == 0) {
            preg_match_all('/[http|ftp|https]{1,}:\/\/?[a-zA-Z0-9.-]*\/*/', $value, $arr);
            if ($arr) {
                $temp['city'] = $arr;
                $i++;
            }
        } else {
            preg_match_all('/m\d+/', $value, $arr);
            if ($arr) {
                $temp['type'] = $arr;
                $i++;
            }
        }
    }
}

file_put_contents('data/config.log', json_encode($temp));
//var_dump($html);exit;