<?php

require_once 'Config.class.php';

$conf = new Config();

$conf->root_path = dirname(__FILE__);
$conf->server_name = 'localhost';
$conf->server_url = 'http://'.$conf->server_name;
$conf->app_root = '/ap04_BS';
$conf->app_url = $conf->server_url.$conf->app_root;

define('_ROOT_PATH', $conf->root_path);
define('_APP_URL', $conf->app_url);
?>