<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}

$id=$_SESSION["id"];

 $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
$time;
$fuck="UPDATE users SET lasttime=NOW() WHERE userID='$id'";
$conn->query($fuck);
$qq="UPDATE time SET time=NOW() WHERE id='0'";
$conn->query($qq);
$qq1="SELECT * FROM time";
$re=$conn->query($qq1);
$hr;$min;$date;$sec;
$countuser=0;





echo '<div class="modal-header"><h1 style="align:right">Online</h1>  
        </div>
        <div class="modal-body">';
if (mysqli_num_rows($re) > 0) {
 while($r5 = $re->fetch_assoc()) {
	$time=$r5["time"]; 
 }}
$on="SELECT userID,lasttime FROM users";
$result= $conn->query($on);
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
       $tempid=$r["userID"];
	   $temptime=$r["lasttime"];
	   if($tempid!=$id)
	 {
	    $d1="SELECT DATEDIFF('$time','$temptime') AS date";
       $re71=$conn->query($d1);
       while($r541 = $re71->fetch_assoc()) {
	      $date=$r541["date"];
		  
	  
       $d="SELECT TIMEDIFF('$time','$temptime') AS time";
       $re7=$conn->query($d);
	   
	    while($r54 = $re7->fetch_assoc()) {
			$r54["time"]=substr($r54["time"],-8,8);
			$hr=substr($r54["time"],0,2);
			$min=substr($r54["time"],-5,2);
			$sec=substr($r54["time"],-2,2);
			 
	   if($date==0){if($hr==0){if($min==0){ if($sec<5){
	    $countuser++;
	    $f6="SELECT imagename FROM images WHERE uid='$tempid' AND spec='propic' ";
		$r6= $conn->query($f6);
		 if(mysqli_num_rows($r6) > 0) {
		 while($ro6= $r6->fetch_assoc()) {
          

		 $f7="SELECT userEmail,userName FROM users WHERE userID='$tempid'";
        $r7= $conn->query($f7);
		 if(mysqli_num_rows($r7) > 0) {
		 while($ro7= $r7->fetch_assoc()) {
          $usern=$ro7["userName"];
		  $usere=$ro7["userEmail"];
		 }}
		 echo '<script>
		 $(document).ready(function(){
			 var touid="'.$tempid.'";
			  var fromuid="'.$id.'";
			 var timg="'. $ro6["imagename"].'";
			 var tname="'.$usern.'";
              $("#chat'.$tempid.'").click(function(){

				  see(touid,fromuid,timg,tname);
				  
                 $("#mchat").modal();

		        });
                  
		  });
     </script>';
          echo '<div class="col-sm-12"><div class="panel panel-default"><span ><a href="profile.php?id='.$usere.'&name='.$usern.'"><img src="images/'.$ro6["imagename"].'"class="img-circle"  width="50" height="50" alt="" />'.$usern.'</a></span><div class="panel panel-default" id="chat'.$tempid.'">
		  <span > chat <span class="glyphicon glyphicon-comment" style="color:green;"></span></span></div></div></div>
		  ';
		       }
		 
		       }
	   
	   
	   
	   }}}}
       
	                               
      
	  
	  
	  
	} }
	
	
	 }	
	}
	                                              
}
echo'<script>
function see(t,f,img,name)
{var d ="touid="+ t + "&fromuid="+ f + "&timg="+ img + "&tname="+ name;
 $.ajax({
                 type: "POST",
                  url: "loadmsg.php",
                  data: d,
                  cache: false,
                    success: function(result){
		          
		             $("#mchat").html(result);
		             
		           }
                 });
}
function msg()
			 {
			   var d ="touid="+ touid + "&fromuid="+ fromuid;
                   $.ajax({
                 type: "POST",
                  url: "writecomment.php",
                  data: d,
                  cache: false,
                    success: function(result){
	                   console.log(result);
		          
		             $("#comment"+cid).prepend(the);
		             console.log(img);
		              console.log(the);
		           }
                 });
		 }</script>';
if($countuser==0)
{echo'No one is Online';}
echo '</div>';
?>