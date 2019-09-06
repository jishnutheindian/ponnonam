<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();
$status=' ';
if(!$user_home->is_logged_in())
{
$status='guest';
}
else
{
$stmt = $user_home->runQuery("SELECT * FROM users WHERE userEmail=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_home->login($email,$upass))
	{
		$user_home->redirect('timeline.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

   <title>
   <?php
   if($status==' '){echo $row['userEmail'].' pec malluz' ;}
   else
   {echo 'PEC malluz introducing the first social website for our comunity';}
   ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/sign.css">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <style>
  .mod {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                  50% 50% 
                no-repeat;
}


body.loading {
    overflow: hidden;   
}


body.loading .mod {
    display: block;
}
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
	  color: #669bff;
    }
    .navbar-default {
	 background-image:linear-gradient(rgb(255, 255, 255), rgb(255, 255, 255));
}
  
.navbar-brand {
	 width:auto;
	 height:auto;
	 
}
    /* Add a gray background color and some padding to the footer */
    footer {
     	 background-image: linear-gradient(rgb(242, 242, 242), rgb(0, 0, 0));
		 padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
	  height: 100%;
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
   body {
      position: relative;
	top: 0px; left: 0px;

  }
  </style>
</head>

<body  data-spy="scroll" data-target=".navbar" data-offset="10">


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     <img class="navbar-brand" src="images/logo.png" width="30px" height="30px"href="#">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a  href="#s1">Home</a></li>
        <li><a  href="#s2">About</a></li>
        <li><a  href="#s3">Projects</a></li>
        <li><a  href="#s4">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
<?php if($status==' ')
{echo'<li><a href="timeline.php"><span class="glyphicon glyphicon-user"></span> account</a></li>
			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			 <script>
			 document.cookie="useremail='.$row['userEmail'].'";
			 </script>
			 ';
}
else
{echo'<li><a href="inup.php?id=signup"><span class="glyphicon glyphicon-log-out"></span> signup</a></li>
       <li><a href="login"><span class="glyphicon glyphicon-log-in"></span> login</a></li>';
}
?>
      </ul>
    </div>
  </div>
</nav>

<span id="r" style="position:absolute; top:117px;">
 <div id="s1" class="container-fluid">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>
	<!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/first.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>Pec Malluz</h3>
          <p>Unity in Unity</p>
        </div>      
      </div>
	  <div class="item">
        <img src="images/second.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>Pec Malluz</h3>
          <p>Happy days</p>
        </div>      
      </div>
    </div>
     <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
 
</div>



<div id="s2" class="container-fluid">

 <div class="container text-center">    
  <h3></h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="images/third.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>in peak</p>
    </div>
    <div class="col-sm-4"> 
      <img src="images/forth.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>make up on</p>    
    </div>
    <div class="col-sm-4">
      <div class="well">
       <p>Ponnonam 16 @ 5.30 pm october 7</p>
      </div>
      <div class="well">
       <p>Get to @ Anna mala International hotel 9th october</p>
      </div>
    </div>
  </div>
 </div><br>

</div>

<footer class="container-fluid text-center">
  <p>Pec Malluz</p>
</footer>

   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="container">
    
      <div class="container" id="l">
      <form class="form-signin" method="post">
	  
        <div class="card card-container">
		<?php if(isset($msg)) echo $msg;  ?>
      <?php
        if(isset($_GET['error']))
		{
			?>
			 <script>
   
			$("#myModal").modal();
		</script>
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
			<script>
  
			$("#myModal").modal();
					</script>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>
		<h2><a href="index.php" > </a></h2>
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
            <a href="fpass.php" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
      
    </div>
  </div> 
     <script>
   $(document).ready(function() {
	   $body = $("body");    
	   $('a[href="login"]').click(function(e){
       e.preventDefault();
	    $body.addClass("loading");   
       $("#myModal").modal();
	   $body.removeClass("loading");
     });
   });
  </script>
  </span>
</body>
<div class="mod"><img src="images/load.gif"></div>
<!-- Mirrored from www.w3schools.com/bootstrap/tryit.asp?filename=trybs_temp_marketing&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Feb 2016 05:16:23 GMT -->
</html>