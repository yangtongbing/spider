<?php
require_once './vendor/autoload.php';

header('Content-Type:text/html;charset=utf8');
$url = "http://china.baixing.com/jinrongfuwu/?page=2";
\phpspider\core\requests::set_cookie('Hm_lvt_5a727f1b4acc5725516637e03b07d3d2', 1532687850);
\phpspider\core\requests::set_cookie('Hm_lpvt_5a727f1b4acc5725516637e03b07d3d2', time());
\phpspider\core\requests::set_cookie('kjj_log_session_id', 15330150938403939405);
\phpspider\core\requests::set_cookie('kjj_log_log_id', 15330150931643807553);
\phpspider\core\requests::set_cookie('BAIDUID', '9B0846D3A1114F3D1B8856A8CB11EE43:FG=1');
\phpspider\core\requests::set_cookie('HMACCOUNT', '9B57A23D5CEF22AE');
\phpspider\core\requests::set_cookie('kjj_log_session_depth', rand(11,99));
\phpspider\core\requests::set_header("Referer", "http://beijing.baixing.com");
$html = \phpspider\core\requests::get($url);
var_dump($html);exit;
// 选择器规则
$selector = "//ul[contains(@class,'list-ad-items')]//li";
// 提取结果
$result = \phpspider\core\selector::select($html, $selector);
var_dump($result);
exit;
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