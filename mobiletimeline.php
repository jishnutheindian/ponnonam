<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userEmail=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION["id"] = $row['userID'];
$_SESSION["username"]= $row['userName'];
$_SESSION["usermail"]= $row['userEmail'];

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>InProlife</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//www.pecmalluz.com/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="//www.pecmalluz.com/js/script.js"></script>
<script type="text/javascript" src="//www.pecmalluz.com/js/cufon-yui.js"></script>
<script type="text/javascript" src="//www.pecmalluz.com/js/arial.js"></script>
<script type="text/javascript" src="//www.pecmalluz.com/js/cuf_run.js"></script>
<!--  Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript--> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 
<script>
window.onload = function() {
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var img = document.getElementById("canvas");
    ctx.drawImage(img, 10, 10);
 
    var canva = document.getElementById("vas");
    var ct = canva.getContext("2d");
    var im= document.getElementById("vas");
    ct.drawImage(im, 10, 10);
};

</script>
<script>
<?php echo 'var email="'.$row['userEmail'].'";';
	?>

	function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getfriends.php?q=" + str, true);
        xmlhttp.send();
    }
}

function show()
{  $("#loadingDiv").show();
  }

$(document).ready(function(){
   $('#imgupload').hide();
	$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
var l="loadtimeline.php?id=";
                 var man=l+email;
				 
				 $("#timeline").load(man);
$("#s2").click(function(){
       
    var k6="about.php?id=";
                 var n6=k6+email;
				 
				 $("#m").load(n6);
				   $("#myModal").modal();
                 
		
    });
   $("#loadingDiv").hide();
  
	$(".up").hide();
    $("#canvas").click(function(){
	 var k="proup.php?id=";
                 var n=k+email;
				 
				 $("#m").load(n);
				  
                 $("#myModal").modal();
	
			
    });
	$("#vas").click(function(){
       
    var k1="wallup.php?id=";
                 var n1=k1+email;
				 
				 $("#m").load(n1);
				  
                 $("#myModal").modal();
		
    });
	$("#search").click(function(){
       
    
				  
                 $("#searchmodal").modal();
		
    });
	$("#cm").click(function(){
       
    var k1="friends.php?id=";
                 var n1=k1+email;
				 
				 $("#m").load(n1);
				   $("#myModal").modal();
                 
		
    });
	$("#rp").click(function(){
       
    var k1="resetpass.php?id=";
                 var n1=k1+email;
				 
				 $("#m").load(n1);
				  
                 $("#myModal").modal();
		
    });

	$("#album").click(function(){
                 var k1="album.php?id=";
                 var n1=k1+email;
			
				 $("#m").load(n1);
				  
                 $("#myModal").modal();  
     
    });


 $("#canvas").mouseenter(function(){
       $(this).fadeTo("slow", 0.7);
	    });
		  $("#vas").mouseenter(function(){
       $(this).fadeTo("slow", 0.7);
	    });
$("#canvas").mouseleave(function(){
  $(this).fadeTo("slow",1.0);
}); 
	$("#vas").mouseleave(function(){
  $(this).fadeTo("slow",1.0);

});});


</script>
<style>

#loadingDiv{
  position:fixed;
  top:0px;
  right:0px;
  width:100%;
  height:100%;
  background-color:#666;
  background-image:url('images/loading.gif');
  background-repeat:no-repeat;
  background-position:center;
  background-attachment: fixed;
  z-index:10000000;
  opacity: 0.4;
  filter: alpha(opacity=40); /* For IE8 and earlier */
}
.glyphicon glyphicon-heart{
    font-size: 60px;
    color:red;
    text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
}
.gly-spin {
  -webkit-animation: spin 2s infinite linear;
  -moz-animation: spin 2s infinite linear;
  -o-animation: spin 2s infinite linear;
  animation: spin 2s infinite linear;
}
@-moz-keyframes spin {
  0% {
    -moz-transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
  }
}
@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
  }
}
@-o-keyframes spin {
  0% {
    -o-transform: rotate(0deg);
  }
  100% {
    -o-transform: rotate(359deg);
  }
}
@keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
.gly-rotate-90 {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.gly-rotate-180 {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}
.gly-rotate-270 {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
  -webkit-transform: rotate(270deg);
  -moz-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  -o-transform: rotate(270deg);
  transform: rotate(270deg);
}
.gly-flip-horizontal {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);
  -webkit-transform: scale(-1, 1);
  -moz-transform: scale(-1, 1);
  -ms-transform: scale(-1, 1);
  -o-transform: scale(-1, 1);
  transform: scale(-1, 1);
}
.gly-flip-vertical {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1);
  -webkit-transform: scale(1, -1);
  -moz-transform: scale(1, -1);
  -ms-transform: scale(1, -1);
  -o-transform: scale(1, -1);
  transform: scale(1, -1);
}
</style>
</head>
<body>


<div class="main">
  <div class="main_resize">
   
     

      
	  <!-- nav bar-->
	  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     <!-- <img class="navbar-brand" src="images/quickearn.png" href="#">-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a  href="index.php">Home</a></li>
        <li><a  id="s2">About</a></li>
        <li><a  href="#s3">Projects</a></li>
        <li><a  href="#s4">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
            			 <li><a id="search"><span class="glyphicon glyphicon-search"></span> search</a></li>

			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        
      </ul>
    </div>
  </div>
</nav>