<?php
session_start();
$pos=$_SESSION["userposition"];
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
else
{
	if($pos!="admin")
	{
      $user_home->redirect('timeline.php');
	}

}
if(isset($_POST['ok']))
{
$stmt = $user_home->runQuery("SELECT * FROM users WHERE userStatus='Y'");
$result=$stmt->execute();
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
$email=$r["userEmail"];
$message="Check out your timeline you have got new Posts and Users.<a href='www.pecmalluz.com'>Click here to login</a>";
$subject="New Notification";
$user_home->send_mail($email,$message,$subject);
 }}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Send mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<button class="btn btn-primary btn-lg"type="submit" name="ok">continue</button>

Why this happening?
</body>
</html>
    