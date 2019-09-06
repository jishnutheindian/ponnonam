<?php
   session_start();
require_once 'class.user.php';
$user_home = new USER();
$n=$_POST['id'];
$usern;
$usere;
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

$f5="SELECT uid from likes WHERE tid='$n'";
		$r5= $conn->query($f5);
       if(mysqli_num_rows($r5) > 0) {
		while($row5= $r5->fetch_assoc()) {
        $curuid=$row5["uid"];
		$f7="SELECT userEmail,userName FROM users WHERE userID='$curuid'";
        $r7= $conn->query($f7);
		 if(mysqli_num_rows($r7) > 0) {
		 while($ro7= $r7->fetch_assoc()) {
          $usern=$ro7["userName"];
		  $usere=$ro7["userEmail"];
		 }}
        $f6="SELECT imagename FROM images WHERE uid='$curuid' AND spec='propic' ";
		$r6= $conn->query($f6);
		 if(mysqli_num_rows($r6) > 0) {
		 while($ro6= $r6->fetch_assoc()) {
          
          echo '<h5><span class="col-sm-3"><a href="profile.php?id='.$usere.'&name='.$usern.'"><img src="images/'.$ro6["imagename"].'"class="img-circle"  width="50" height="50" alt="" />'.$usern.'</a></span></h5>';
		       }
		 
		       }
	
	      }

          }

?>