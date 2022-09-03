<?php
ob_start();

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

ini_set('date.timezone','UTC');
date_default_timezone_set('UTC');
session_start();

require_once('settings.php');
require_once('classes/DBCon.php');
require_once('classes/SystemSettings.php');

$db = new DBCon;
$conn = $db->conn;

function redirect($url='') {
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}

function validate_image($file){
    $ex_file = explode("?",$file)[0];
	if(!empty($ex_file)){
			// exit;
		if(is_file(base_app.$ex_file)){
			return base_url.$file;
		}else{
			return base_url.'dist/img/no-image-available.png';
		}
	}else{
		return base_url.'dist/img/no-image-available.png';
	}
}
ob_end_flush();
?>