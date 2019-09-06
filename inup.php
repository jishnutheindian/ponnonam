<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('index.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		$user_login->redirect('index.php');
	}
}

if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$mob=    trim($_POST['txtmob']);
	$dob=    trim($_POST['txtdob']);
	$sex=    trim($_POST['txtsex']);
	$code = md5(uniqid(rand()));
	
	$stmt = $user_login->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
	}
	else
	{  $stm = $user_login->runQuery("SELECT * FROM users WHERE mob=:user_mob");
	   $stm->execute(array(":user_mob"=>$mob));
	   $ro = $stm->fetch(PDO::FETCH_ASSOC);
      if($stm->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  mobile number allready exists , Please Try another one
			  </div>
			  ";
	}
		else
		{
		if($user_login->register($uname,$email,$upass,$mob,$dob,$sex,$code))
		{			
			$id = $user_login->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to Quick Earn<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://miontech.in/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirm Registration";
						
			$user_login->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	} }
}
?>
<!doctype html >
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
<script src="lib/jquery-3.1.0.min.js"></script>
  <script>
$(document).ready(function(){
    <?php
		  if($_GET['id']=="signup"){
			  echo'$("#l").hide();$("#s").show();';

	  }
	else{echo '$("#s").hide();$("#l").show();';
	} ?>  
            $("#signup").click(function(){
                          $("#l").hide();
		                  $("#s").show();
             });

	$("#login").click(function(){
        $("#s").hide();
		$("#l").show();
    });


    $(".confirm_password").change(function(){
       if( $(this).val() == $(".password").val())
		{  
		    $("#message").html("<div class='alert alert-success'>password matching</div>");
		 }
		else
		{
          $("#message").html("<div class='alert alert-error'>password not matching</div>");
		    $(this).val("");
			$(".password").val("");
 		}
	});
 

});
 </script>

<link rel="stylesheet" href="css/sign.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     </head>

 <body>
 <div class="banner"> 


      <div class="container" id="l">
      <form class="form-signin" method="post">
	  
        <div class="card card-container">
		<?php if(isset($msg)) echo $msg;  ?>
      <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong> Wrong Details!</strong> 
			</div>
            <?php
		}
		?>
			<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>
		<h2><a href="index.php" ><img src="images/quickearn.png"> </a></h2>
            <img id="profile-img" class="profile-img-card" src="images/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
                 <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="txtemail" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="txtupass" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  name="btn-login">Sign in</button>
            </form><!-- /form -->
		    <button class="btn btn-lg btn-primary btn-block btn-signin" id="signup" >Sign Up</button>
            <a href="fpass.php" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

<div class="container" id="s">
 <form class="form-signin" method="post">
    <div class="card card-container">
            <p id="profile-name" class="profile-name-card"></p>
                 <span id="reauth-email" class="reauth-email"></span>
  <h2><a href="index.php" ><img src="images/quickearn.png"> </a></h2>
        <input type="text"  id="inputEmail" class="form-control" placeholder="Full name" name="txtuname" required autofocus />
        <input type="email"  id="inputEmail" class="form-control" placeholder="Email address" name="txtemail" required />
        <input type="password"  id="inputPassword"  class="password" class="form-control" placeholder="Password" name="txtpass" required />
	    <input type="password"    id="inputPassword"  class="confirm_password" placeholder="Re-type Password" name="txtpass"  required />
		<span id='message'></span>
		<input type="tel"  id="inputPassword"  placeholder="Mobile Number" name="txtmob" required />
		
        <h5> Sex</h5>
<div class="form-control">		
<input type="radio" name="txtsex" value="male" /> Male
<input type="radio" name="txtsex" value="female" /> Female
<input type="radio" name="txtsex" value="other" /> Other
</div>
<br>
<h5>Date of Birth</h5>
<div id="date1" class="datefield">
<input  type="text"  id="inputPassword" class="form-control" name="txtdob" placeholder="DD/MM/YYYY"/>
</div>

<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  name="btn-signup">Sign Up</button>
  <button class="btn btn-lg btn-primary btn-block btn-signin" id="login"  name="btn-login">Sign In</button>
      </form>
   </div>
 </body>
 
</html>
