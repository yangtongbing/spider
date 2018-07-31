<?php
require_once './vendor/autoload.php';
require_once './simple_html_dom.php';

header('Content-Type:text/html;charset=utf8');
$url = "http://china.baixing.com/jinrongfuwu/?afo=Quw";
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
        ];
        foreach ($html->find('.media-body-title span button') as $value) {
            $tmp['mobile'] = $value->attr['data-contact'];
        }

        if ($html->find('.ad-item-detail a')) {
            $tmp['company'] = $html->find('.ad-item-detail a')[0]->plaintext;
        }

        $temp[] = $tmp;
    }
}
file_put_contents('data/test.log', json_encode($temp));