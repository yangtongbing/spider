<?php
require_once './vendor/autoload.php';

/* Do NOT delete this comment */
/* 不要删除这段注释 */
$configs = array(
    'log_show' => true,
    'log_file' => 'data/zhihu.log',
    'log_type' => 'error,debug',
    'output_encoding' => 'GB2312',
    'export' => array(
        'type'  => 'sql',
        'file'  => 'data/zhihu.sql',
        'table' => '数据表',
    ),
    'name' => '知乎',
    'domains' => array(
        'zhihu.com',
        'www.zhihu.com'
    ),
    'scan_urls' => array(
        'https://www.zhihu.com/'
    ),
    'content_url_regexes' => array(
        "http://beijing.baixing.com/jinrongfuwu/?page=\d+"
    ),
    'list_url_regexes' => array(
        "http://beijing.baixing.com/jinrongfuwu/?page=\d+"
    ),
    'fields' => array(
        array(
            'name' => "content",
            'selector' => '#<div\sclass="HomeMainItem">([^/]+)</div>#i',
            'required' => true
        ),
        array(
            'name' => "mobile",
            'selector' => "#<span\sclass=\"CopyrightRichText-richText\">([^/]+)</span>#i",
            'required' => true
        ),
    ),
);
$spider = new \phpspider\core\phpspider($configs);
$spider->on_start = function($spider)
{
    \phpspider\core\requests::set_cookie('Hm_lvt_5a727f1b4acc5725516637e03b07d3d2', 1532687850);
    \phpspider\core\requests::set_cookie('Hm_lpvt_5a727f1b4acc5725516637e03b07d3d2', 1533001791);
    // 把Cookie设置到 weibo.com 域名下
    \phpspider\core\requests::set_timeout(10);
    \phpspider\core\requests::set_useragent(
        array(
        "Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/",
        "Opera/9.80 (Android 3.2.1; Linux; Opera Tablet/ADR-1109081720; U; ja) Presto/2.8.149 Version/11.10",
        "Mozilla/5.0 (Android; Linux armv7l; rv:9.0) Gecko/20111216 Firefox/9.0 Fennec/9.0"
        )
    );
    \phpspider\core\requests::set_referer("https://www.zhihu.com/");
    \phpspider\core\requests::set_header("Referer", "https://www.zhihu.com/");
};

$spider->start();