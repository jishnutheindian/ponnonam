<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}

$id=$_SESSION["id"];
$pic=$_SESSION["imagename"];
 $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
$f=$_POST['fromuid'];
$t=$_POST['touid'];
$img=$_POST['timg'];
$name=$_POST['tname'];


echo '<script>
$(document).ready(function(){
$("#input-custom-sizer").emojiPicker();
});
</script>
<link href="chat.css" rel="stylesheet" type="text/css" />
<section class="module">
  
  <header class="top-bar">
    
    <div class="left">
      <span class="icon typicons-message"></span>
      <h4><img src="images/'.$img.'"class="img-circle"  width="50" height="50"/> '.$name.'</h4> 
    </div>
    
    <div class="right">
      <span class="icon typicons-minus"></span>
      <span class="icon typicons-times"></span>
    </div>
    
  </header>
  
';
echo' <textarea name="comment" id="input-custom-sizer" class="emojiable-option" rows="1" cols="50"></textarea>
  <input type="submit" class="btn btn-info" value="send" name="submit" onclick="msgfun()"><ol class="discussion">';

$smt="SELECT * FROM messages WHERE fromuid='$f' OR fromuid='$t'";
$re=$conn->query($smt);
if (mysqli_num_rows($re) > 0) {
 while($r5 = $re->fetch_assoc()) {
$tempmsg=$r5["message"];
$tempf=$r5["fromuid"];
$tempt=$r5["touid"];
$temptime=$r5["time"];
if($tempf==$f)
{
echo'<li class="self">';
}
else
{
echo'<li class="other">';
}

echo'<h5> </h5>';
echo' <div class="avatar">
        <img src="images/';if($tempf==$f)
{
echo $pic;
}
else
{
echo $img;
}
		echo'" />
      </div>
      <div class="messages">
        <h4>'.$tempmsg.'</h4>
        <h5><time> '.$temptime.'</time></h5>
      </div>
    </li>';

 }}
 else
 {
 echo'Start Conversation Now';
 }
 echo' </ol>
 
</section>
';

?>