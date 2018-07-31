<?php
require_once './vendor/autoload.php';
require_once './simple_html_dom.php';

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
// 选择器规则
$selector = "//ul[contains(@class,'list-ad-items')]//li/div";
// 提取结果
$result = \phpspider\core\selector::select($html, $selector);

if ($result) {
    $html = new simple_html_dom();
    $temp = [];
    foreach ($result as $value) {
        $html->load($value);
        $tmp = [
            'mobile' => '',
            'company' => '',
            'zone' => '',
        ];
        foreach ($html->find('.media-body-title span button') as $value) {
            $tmp['mobile'] = $value->attr['data-contact'];
        }

        if ($html->find('.ad-item-detail a')) {
            $tmp['company'] = $html->find('.ad-item-detail a')[0]->plaintext;
        }

        $zone = $html->find('.ad-item-detail')[0]->plaintext;
        $zone = explode('-', $zone);
        $tmp['zone'] = trim($zone[0]);

        $temp[] = $tmp;
    }
}
file_put_contents('data/test.log', json_encode($temp));