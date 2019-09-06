           <?php
		   session_start();
require_once 'class.user.php';
$user_home = new USER();
$tr="'";
$maxnum=0;
$maxnum=$_GET["num"];
/*echo'<script type="text/javascript">
document.write('.$tr.'<s'.$tr.'+'.$tr.'cript type="text/javascript" src="//ubercpm.com/show.php?z=27&pl=47599&j=1&code='.$tr.'+new Date().getTime()+'.$tr.'"></s'.$tr.'+'.$tr.'cript>'.$tr.');</script>'; */

if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}
$uname=$_SESSION["username"];
$curid=$_SESSION["id"];
$inimage=$_SESSION["imagename"];
		     $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
echo'<script>
function checkcomment( cid )
{  var uname="'.$uname.'";
	var img="'.$inimage.'";
var v= "write"+cid;
var postcom = $("#"+v).val();
if(postcom =="")
{$("#"+v).val(" write something"); }
else
{ 
 var d ="tid="+ cid + "&post="+ postcom + "&uid="+ '.$curid.';
$.ajax({
type: "POST",
url: "writecomment.php",
data: d,
cache: false,
success: function(result){
	     console.log(result);
		 var the1= '.$tr.' <div class="panel panel-default"><div class="panel-body"><h5><span class="col-sm-3"><img src="images/'.$tr.' + img ; 
		 var the2='.$tr.'"class="img-circle"  width="50" height="50" alt="" /> '.$tr.' + uname;
		 var the3= '.$tr.'</span></h5><span class="col-sm-9">'.$tr.' + postcom ;
		 var the4='.$tr.'</span></div></div>'.$tr.';
         var the= the1+the2+the3+the4;
		  $("#comment"+cid).prepend(the);
		  console.log(img);
		  console.log(the);
		 }
});
}

}

</script>';

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
	
$file = "SELECT * FROM timeline ORDER BY num DESC LIMIT $maxnum,5";
$userimage="";
$mail;
$uid;
$tid;
$n=0;
$c=0;
$ad=0;
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

echo'<script>

	$(document).ready(function(){
		var d'.$n.';
		var i="i";
		var d="d";
		var man'.$n.'=0;
		var man1'.$n.'=0;
		$("#like'.$n.'").hide();
		$("#write'.$n.'").emojiPicker(); 
		$("#hide'.$n.'").hide();
		$("#comment'.$n.'").hide();


		$("#dd'.$n.'").click(function(){
           if(man'.$n.'%2==0)
	 {
        var dataSt ="id="+ '.$n.';
$.ajax({
type: "POST",
url: "loveusers.php",
data: dataSt,
cache: false,
success: function(result){
	$("#like'.$n.'").html(result);
	$("#like'.$n.'").show();
	$("#dd'.$n.'").html("Hide this panel");
      
	  man'.$n.'++;
		 }
});
 }
 else{
 $("#dd'.$n.'").html("Show members who liked this");
      $("#like'.$n.'").hide();
	  man'.$n.'++;
 }
          });
		 ';
		 
echo '
$("#com'.$n.'").click(function(){
	
      if(man1'.$n.'%2==0)
	 {
        var dataStr ="tid="+ '.$n.';
$.ajax({
type: "POST",
url: "showcomment.php",
data: dataStr,
cache: false,
success: function(result){
	     $("#hide'.$n.'").show();
	     $("#comment'.$n.'").html(result);
		 var fun='.$tr.'<span class="glyphicon glyphicon-minus-sign" style="color:grey;"></span>comment'.$tr.';
		 document.getElementById("com'.$n.'").innerHTML = fun;
         $("#comment'.$n.'").show();
	     man1'.$n.'++;
		 }
});
 }
 else{$("#hide'.$n.'").hide();
	 var fun='.$tr.'<span class="glyphicon glyphicon-comment" style="color:grey;"></span> comment'.$tr.';
 document.getElementById("com'.$n.'").innerHTML = fun;
      $("#comment'.$n.'").hide();
	  man1'.$n.'++;
 }
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
         </div>
		 <div class="panel panel-default">

		 <button id="cb'.$n.'"type="button" class="col-sm-6" style="background-color: white;border: none;">
		  <span id="heart'.$n.'" class="glyphicon glyphicon-heart gly-spin" style"color:black;"></span><span id="count'.$n.'"> '.$r["loves"].' </span> people love this 
		  </button>
        
		<button id="com'.$n.'"type="button" class="col-sm-6" style="background-color: white;border: none;"><span class="glyphicon glyphicon-comment" style="color:grey;"></span> comment </button>
		</div>

		<div id="hide'.$n.'"class="panel panel-default">
  <div class="panel-body">

  <h5 style="align:right">
<input type="text" class="emojiable-option" id="write'.$n.'"><button onclick="checkcomment('.$n.')">comment</button>
</h5>  
  
  </div>
</div>
		<div id="comment'.$n.'" style="overflow:scroll; max-height:100px;"></div>
		<button id="dd'.$n.'"type="button" class="btn btn-default btn-block" style="color:grey;">Show members who liked this</button>
		<div id="like'.$n.'" style="overflow:scroll; max-height:100px;"></div>
		';
		
		echo'</div>';
     }
}


		  ?>