<?php
session_start();
require_once 'class.user.php';
$user = new USER();
$me=$_SERVER['HTTP_REFERER'];
$m=substr($me,27,strlen($me));

if(!$user->is_logged_in())
{
	$user->redirect('index.php');
}

if($user->is_logged_in()!="")
{
	$user->logout();
	$user->redirect('index.php');
}
?>