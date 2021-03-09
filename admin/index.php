<?php
ob_start();
session_start();
include_once('__autoload.php');
include_once('../functions/database.php');
$action = new action_page();
$acc = new action_account();
$order = new action_order();
// $kiotviet = new action_kiotviet();
// $kiotviet->set_token();
// $kiotviet->danh_muc_cap_1();
if($acc->isLoginAdmin()){
	include_once('admin.php');
}else{
	include_once('Login.php');
}

