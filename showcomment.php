<?php

session_start();
require_once 'class.user.php';
$user_home = new USER();
$tid=$_POST['tid'];
$name;
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

$f="SELECT * FROM COMMENT WHERE tid='$tid' ORDER BY id DESC";
$r1= $conn->query($f);
		if (mysqli_num_rows($r1) > 0) {
      while($row = $r1->fetch_assoc()) {
          $u=$row["uid"];
		  $post=$row["post"];
		  $f2="SELECT imagename FROM images WHERE uid='$u' AND spec='propic'";
		   
          $r2= $conn->query($f2);
		  if (mysqli_num_rows($r2) > 0) {
      while($ro = $r2->fetch_assoc()) {
          $img=$ro["imagename"];
		   		  $f3="SELECT userName FROM users WHERE userID='$u'";

          $r3= $conn->query($f3);
		  if (mysqli_num_rows($r3) > 0) {
      while($ro3 = $r3->fetch_assoc()) {
            $name=$ro3["userName"];
      }}


          echo'<div class="panel panel-default">
  <div class="panel-body"><h5><span class="col-sm-3"><img src="images/'.$img.'"class="img-circle"  width="50" height="50" alt="" />'.$name.'</span></h5>
   <span class="col-sm-9">'.$post.'</span>
  
  
  </div>
</div>';


	  }}
	  }}
	  else{echo 'No comments Yet,Be the First to comment';}

?>