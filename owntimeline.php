           <?php
		    $mail=$_GET['id'];
		   session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}
$curid=$_SESSION["id"];
		     $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }

echo '<script>
 function love(id, operation ,uid)
	 {
		 var dataS ="id="+ id + "&operation="+ operation + "&uid="+ '.$curid.';
$.ajax({
type: "POST",
url: "love.php",
data: dataS,
cache: false,
success: function(result){
	console.log(result);
         return true;
		 }
});

     }	
	 </script>';
	
$file = "SELECT * FROM timeline WHERE usermail ='$mail' ORDER BY num DESC";
$userimage="";
$mail;
$uid;
$tid;
$n=0;
$c=0;
$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {

 while($r = $result->fetch_assoc()) {
$mail=$r["usermail"];
$n=$r["num"];
$kin="SELECT userID FROM users WHERE userEmail='$mail'";
$rkin= $conn->query($kin);
if (mysqli_num_rows($rkin) > 0) {
 while($rowkin = $rkin->fetch_assoc()) {
        $uid=$rowkin["userID"];
		
     }

}

$f= "SELECT imagename FROM images WHERE userEmail='$mail' AND spec='propic' ";
$r1= $conn->query($f);
if (mysqli_num_rows($r1) > 0) {
 while($row = $r1->fetch_assoc()) {
        $userimage=$row["imagename"];
		
     }

}
$f4="SELECT uid from likes WHERE tid='$n' AND uid='$curid'";
$r4= $conn->query($f4);
if (mysqli_num_rows($r4) > 0) {
	$c=1;
}
/*$("#count'.$n.'").click(function(){ $(#like'.$n.').show();});
		$("#count'.$n.'").hover(function(){
    $(#like'.$n.').show();
    }, function(){
    $(#like'.$n.').hide();
});*/
echo'<script>

	$(document).ready(function(){
		var d'.$n.';
		var i="i";
		var d="d";
		$("#like'.$n.'").hide();
		$("#dd'.$n.'").click(function(){

        var dataSt ="id="+ '.$n.';
$.ajax({
type: "POST",
url: "loveusers.php",
data: dataSt,
cache: false,
success: function(result){
	$("#like'.$n.'").html(result);
      $("#like'.$n.'").show();
		 }
});
          });
		 ';

       if($c==1)
	 {
		echo 'var k1'.$n.'=1;$("#heart'.$n.'").css("color","red");';$c=0;}
		else
	 {echo 'var k1'.$n.'=0;';}
		echo'
    $("#cb'.$n.'").click(function(){
k1'.$n.'++;
       if(k1'.$n.'%2==0)
{    $("#heart'.$n.'").css("color","black");
    d'.$n.'=$("#count'.$n.'").text();
	d'.$n.'--;
    love('.$n.',d,'.$uid.');
	 
	  $("#count'.$n.'").text(d'.$n.');
      
      
 }
 else
 {
       $("#heart'.$n.'").css("color","red");

    d'.$n.'=$("#count'.$n.'").text();
	d'.$n.'++;
	love('.$n.',i, '.$uid.');
	 
    $("#count'.$n.'").text(d'.$n.');
      
  } 

    });
});
	</script>';
	 echo' <div class="panel panel-default"><div class="article"><h5><span>';
	
	 echo'<img src="images/'.$userimage.'" class="img-circle"  width="50" height="50">  ';
		 echo $r["usermail"].'</span></h5><h6>  posted an update</h6>';
        echo '<div class="clr"></div>';
		echo '<p class="post-data"><span class="date">'.$r["time"].'</span></p>';
		 if( $r["imagesrc"]!="")
	 {
		echo '<img src="images/'.$r["imagesrc"].'" width="auto" height="193" alt="" />';
	 }
        echo '<br><p><h4>'.$r["post"].'</h4></p><div class="clr"></div>
         </div> <button id="cb'.$n.'"type="button" class="btn btn-default btn-block" style="color:grey;">
		  <span id="heart'.$n.'" class="glyphicon glyphicon-heart gly-spin" style"color:black;"></span><p id="count'.$n.'">'.$r["loves"].'</p> people love this 
        </button> <button id="dd'.$n.'"type="button" class="btn btn-default btn-block" style="color:grey;">Show members who liked this</button>';
		echo '<div id="like'.$n.'">';
		
		echo'</div></div>';
     }
}

		  ?>