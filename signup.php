<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
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
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to Coding Cage!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://prolife.ddns.net/account/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
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
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Signup | Coding Cage</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	
<script>
function bar(txtBox) {
  if (txtBox == null) {
    return ''
  }

  var re = new RegExp(/(\d{6})(\d{2})?/);

  if (re.test(txtBox.value)) {
    if (txtBox.value.length == 8) {
      txtBox.value = txtBox.value.substring(0, 2) + '/' + txtBox.value.substring(2, 4) + '/' + txtBox.value.substring(4, 8)
    }
    if (txtBox.value.length == 7) {
      txtBox.value = txtBox.value.substring(0, 2) + '/' + txtBox.value.substring(2, 3) + '/' + txtBox.value.substring(3, 8)
    }

    if (txtBox.value.length == 6) {
      if (txtBox.value.substring(4, 6) < 20) {
        txtBox.value = txtBox.value.substring(0, 2) + '/' + txtBox.value.substring(2, 4) + '/20' + txtBox.value.substring(4, 6);
      } else {
        txtBox.value = txtBox.value.substring(0, 2) + '/' + txtBox.value.substring(2, 4) + '/19' + txtBox.value.substring(4, 6);
      }
    }
  }
  return txtBox.value;
}</script>
  
  </head>
  <body id="login">
    <div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        <input type="text" class="input-block-level" placeholder="full name" name="txtuname" required />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
		<input type="tel" class="input-block-level" placeholder="Mobile Number" name="txtpass" required />
        <h5> Sex</h5>
		
<input type="radio" name="sex" value="male" />Male
<input type="radio" name="sex" value="female" />Female
<input type="radio" name="sex" value="other" />Other
<br>
<h5>Date of Birth</h5>
<div id="date1" class="datefield">
<input  type="text" id="dob" placeholder="DD/MM/YYYY"/>
</div>
<h5>Locality</h5>
 <select name="country" class="countries" id="countryId">
<option value="">Select Country</option>
</select>
<select name="state" class="states" id="stateId">
<option value="">Select State</option>
</select>
<select name="city" class="cities" id="cityId">
<option value="">Select City</option>
</select>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/location.js"></script>    	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>