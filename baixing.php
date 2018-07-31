<?php
require_once './vendor/autoload.php';

/* Do NOT delete this comment */
/* 不要删除这段注释 */
$configs = array(
    'log_show' => true,
    'log_file' => 'data/baixing.log',
    'log_type' => 'error,debug',
    'output_encoding' => 'GB2312',
    'input_encoding' => 'GB2312',
    'export' => array(
        'type'  => 'sql',
        'file'  => 'data/baixing.sql',
        'table' => '数据表',
    ),
    'name' => '百姓',
    'domains' => array(
        'baixing.com',
        'beijing.baixing.com'
    ),
    'scan_urls' => array(
        'http://beijing.baixing.com/'
    ),
    'content_url_regexes' => array(
        "http://beijing.baixing.com/jinrongfuwu/?page=\d+"
    ),
    'list_url_regexes' => array(
        "http://beijing.baixing.com/jinrongfuwu/?page=\d+"
    ),
    'fields' => array(
        array(
            'name' => "mobile",
            'selector' => "//ul[contains(@class,'list-ad-items')]//li/div/div[0]/span/button/@data-contact",
            'required' => true
        ),
        array(
            'name' => "company",
            'selector' => "//ul[contains(@class,'list-ad-items')]//li/div/div[1]/time[0]",
            'required' => true
        ),
    ),
);
$spider = new \phpspider\core\phpspider($configs);
$spider->on_start = function($spider)
{
    \phpspider\core\requests::set_cookie('Hm_lvt_5a727f1b4acc5725516637e03b07d3d2', 1532687850);
    \phpspider\core\requests::set_cookie('Hm_lpvt_5a727f1b4acc5725516637e03b07d3d2', time());
    \phpspider\core\requests::set_cookie('kjj_log_session_id', 15330150938403939405);
    \phpspider\core\requests::set_cookie('kjj_log_log_id', 15330150931643807553);
    \phpspider\core\requests::set_cookie('BAIDUID', '9B0846D3A1114F3D1B8856A8CB11EE43:FG=1');
    \phpspider\core\requests::set_cookie('HMACCOUNT', '9B57A23D5CEF22AE');
    \phpspider\core\requests::set_cookie('kjj_log_session_depth', '11');
//    \phpspider\core\requests::set_timeout(10);
//    \phpspider\core\requests::set_useragent(
//        array(
//        "Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/",
//        "Opera/9.80 (Android 3.2.1; Linux; Opera Tablet/ADR-1109081720; U; ja) Presto/2.8.149 Version/11.10",
//        "Mozilla/5.0 (Android; Linux armv7l; rv:9.0) Gecko/20111216 Firefox/9.0 Fennec/9.0"
//        )
//    );
//    \phpspider\core\requests::set_referer("http://beijing.baixing.com");
    \phpspider\core\requests::set_header("Referer", "http://beijing.baixing.com");
};

$spider->on_extract_field = function ($filename, $data, $page) {
    if ($filename == 'mobile') {
        file_put_contents('data/ceshi.log', time()  .'|'. json_encode($data). "\r\n");
    }
};

$spider->start();
