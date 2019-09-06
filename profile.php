<?php
$email=$_GET['id'];
$name=$_GET['name'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>InProlife</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<!--  Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript--> 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 
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
<?php echo 'var email="'.$email.'";';
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
$(document).ready(function(){
var l="owntimeline.php?id=";
                 var man=l+email;
				 
				 $("#timeline").load(man);

   $("#pics").hide();
	$(".up").hide();
   
	$("#search").click(function(){
       
    
				  
                 $("#searchmodal").modal();
		
    });
	$("#s2").click(function(){
       
    var k6="about.php?id=";
                 var n6=k6+email;
				 
				 $("#m").load(n6);
				   $("#myModal").modal();
                 
		
    });
	
	$("#cm").click(function(){
       
    var k1="friends.php?id=";
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
      <img class="navbar-brand" src="images/quickearn.png" href="#">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a  href="index.php">Home</a></li>
        <li><a  id="s2">About</a></li>
        <li><a  id="s3">Projects</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
                <li><a href="timeline.php"><span class="glyphicon glyphicon-user"></span> account</a></li>
						 <li><a id="search"><span class="glyphicon glyphicon-search"></span> search</a></li>

        
      </ul>
    </div>
  </div>
</nav>
     
        
      <div class="me" style="position: relative; left: 0; top: 0px;">
     <div class="bgc" id="134">
	  
	  <?php
	  $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
      $fi=$f=" ";
$mail=$email;
$file = "SELECT imagename FROM images WHERE userEmail='$mail' AND spec='propic' ";
$fwall="SELECT imagename FROM images WHERE userEmail='$mail' AND spec='wallpic' ";
$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
        $f=$r["imagename"];
     }
}
$rwall= $conn->query($fwall);
if (mysqli_num_rows($rwall) > 0) {
 while($rw = $rwall->fetch_assoc()) {
        $fi=$rw["imagename"];
     }
}

echo '<img src="images/',$fi,'" id="vas" class="hbg" width="923" height="291" alt=""/><img src="images/',  $f;
	



	  ?>" class="propic" id="canvas" alt=""/>
	  <h8><?php echo $name; ?></h8>
	  <!---->
	  </div></div>
<div id="pics">
 
</div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
		
 <h2><span>Timeline</span></h2>
          <div id="timeline">
		  </div>
        </div>
<div class="sidebar">
          <div class="gadget">
            <h2 class="star"><span>Sidebar</span> Menu</h2>
            <div class="clr"></div>
            <ul class="sb_menu">
              <li class="active"><a href="#">Home</a></li>
           <li>
		   <div id="album">Album
		   <div></li>
		  
              <div id="cm"><li>community</li></div>
             
            </ul>
          </div>
         
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->
      <div class="modal-content">
      <div id="m">

	  </div>
        <div class="modal-footer">
          <br>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div></div></div>

	  <!-- search modal -->
  <div class="modal fade" id="searchmodal" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->
      <div class="modal-content">
     <div class="modal-header"><h3 style="align:right"><form>
<input type="text" onkeyup="showHint(this.value)">
</form></h3>  
          <h4 class="modal-title">Search inside Community</h4>
        </div>
        <div class="modal-body" id="txtHint">

</div>
        <div class="modal-footer">
          <br>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div></div></div>




</body>

</html>