<?php
/**
Plugin Name: Don't Log Health Checker
Plugin URI: https://github.com/guessi/yourls-dont-log-health-checker
Description: Don't Log Health Checker
Version: 1.0.1
Author: guessi
Author URI: http://github.com/guessi
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

function dlhc_is_health_check() {
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    // common health checker to skip (sort alphabetically)
    // imported from distilnetworks.com (Apr 28, 2018):
    // - https://www.distilnetworks.com/bot-directory/category/site-monitor/
    $keyword = array(
        '200pleasebot',
        'amazon route 53',
        'amsu',
        'cloudflare',
        'codeguard',
        'comodo spider',
        'comodo ssl checker',
        'comodo-certificate-spider',
        'comodo-webinspector-crawler',
        'comodospider',
        'copperegg',
        'crawler',
        'crawlerprocess',
        'crazywebcrawler',
        'datadog',
        'deepcrawl',
        'downnotifier',
        'downtimedetector',
        'elb-healthchecker',
        'freshpingbot',
        'gomezagent',
        'gooblog',
        'googlehc',
        'gotsitemonitor',
        'grepnetstatbot',
        'gtmetrix',
        'hawkreader',
        'hosttracker',
        'inspingbot',
        'internetseer',
        'internetvista',
        'ips-agent',
        'linkcheck',
        'linkstats',
        'linktiger',
        'loadimpactpageanalyzer',
        'loadimpactrload',
        'logicmonitor',
        'mappercmd',
        'mfibot',
        'mon.itor.us',
        'monitis.com',
        'monitor',
        'monitoring',
        'monitority',
        'montastic',
        'montools',
        'netcraft',
        'nimbubot',
        'nmap',
        'nomore404',
        'onpagebot',
        'paessler',
        'panopta',
        'pingbot',
        'pingdom',
        'pingometer',
        'powermapper',
        'project25499',
        'ptst',
        'qualidator',
        'siteanalyzer',
        'sitecheck',
        'siteimprove',
        'sitemonitor',
        'siteuptime',
        'sortsitecmd',
        'uptimerobot',
        'vaultpress',
        'xenu link sleuth',
        'zabbix'
    );

    $is_hc = (str_replace($keyword, '', $user_agent) != $user_agent);

    return $is_hc;
}

// Hook register
yourls_add_filter('shunt_update_clicks', 'dlhc_skip_if_health_checker');
yourls_add_filter('shunt_log_redirect', 'dlhc_skip_if_health_checker');

// Skip if the user-agent shows that it is a service health check
function dlhc_skip_if_health_checker() {
    return dlhc_is_health_check();
}
