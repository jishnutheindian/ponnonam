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
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
 <link rel="stylesheet" type="text/css" href="css/jquery.emojipicker.css">
  <script type="text/javascript" src="js/jquery.emojipicker.js"></script>

  <!-- Emoji Data -->
  <link rel="stylesheet" type="text/css" href="css/jquery.emojipicker.tw.css">
  <script type="text/javascript" src="js/jquery.emojis.js"></script>

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
var gh="&num=0"
                 var man=l+email+gh;
				 
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
$mail=$row['userEmail'];

$file = "SELECT imagename FROM images WHERE userEmail='$mail' AND spec='propic' ";
$fwall="SELECT imagename FROM images WHERE userEmail='$mail' AND spec='wallpic' ";
$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
        $f=$r["imagename"];
		$_SESSION["imagename"]=$f;
     }
}
$rwall= $conn->query($fwall);
if (mysqli_num_rows($rwall) > 0) {
 while($rw = $rwall->fetch_assoc()) {
        $fi=$rw["imagename"];
		
     }
}
//new
$fuck="UPDATE users SET lasttime=NOW() WHERE userEmail='$mail'";
$conn->query($fuck);
//endnew
echo '<img src="images/',$fi,'" id="vas" class="hbg" width="923" height="291" alt=""/><img src="images/',  $f;
	



	  ?>" class="propic" id="canvas" alt=""/>
	  <h8><?php echo $row['userName']; ?></h8>
	  <!---->
	  </div></div>


<script>
//new

var online = setInterval(function () {
    $.get("online.php", function(data, status){
		$("#onlineusers").html(data);
		

    });
},2000);
//new
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
     
      $('#input-custom-size').emojiPicker({
        width: '300px',
        height: '200px'
      });

     
    });
  </script>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
		<!--timeline-->
		<form action="updatetimeline.php?id=<?php echo $row['userEmail'];
		?>"enctype="multipart/form-data" method="post">  
    <br><br>
	what's on your mind?
  <br><br>
  
 <textarea name="comment" id="input-custom-size" class="emojiable-option" rows="1" cols="50"></textarea>
  
    <input type="submit" class="btn btn-info" value="share" name="submit" onclick="show()">


<input type="file" id="imgupload" name="fileToUpload"/> 
<img src="images/pin.png" id="OpenImgUpload" width="50px" height="50px">

</form>
<!--end-timeline-->
<br><br>

 <h2><span>Timeline</span></h2>
          <div id="timeline">
		  </div>
		  		<button id="loadpage" type="button" class="btn btn-default btn-block" style="color:grey;">Load more Posts</button>

		  <div class="modal fade" id="mchat" role="dialog">
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
              <div id="rp"> <li>reset password</li></div>
              <li><a href="logout.php">logout</a></li>
            </ul>
          </div>
		
         <div class="sidebar" id="onlineusers">
		 </div>
         
		 <!--ad-->
		

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

<script>
$(document).ready(function() {
	var num=5;
	$("#loadpage").click(function(){
	var dataS ="num="+ num;
$.ajax({
type: "GET",
url: "loadtimeline.php",
data: dataS,
cache: false,
success: function(result){
						$('#timeline').append(result);
						num=num+5;		 }
});
	
	});

	$(window).scroll(function(){
if ($(window).scrollTop() == $(document).height() - $(window).height()){
var dataSt ="num="+ num;
$.ajax({
type: "GET",
url: "loadtimeline.php",
data: dataSt,
cache: false,
success: function(result){
						$('#timeline').append(result);
						num=num+5;		 }
});
              
}
});

});

</script>

<div id="loadingDiv">
    <div>
        <h7>Please wait...</h7>
    </div>
</div>
</body>

</html>