<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();
$tid=$_POST['tid'];
$post=$_POST['post'];
$uid=$_POST['uid'];
if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}

	  $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }

$f="INSERT INTO COMMENT(uid,tid,post) VALUES('$uid','$tid','$post')";
$r1= $conn->query($f);
return true;
?>