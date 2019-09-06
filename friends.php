<?php
$mail=$_GET['id'];
echo '<div class="modal-header"><h1  style="text-align: center;"> Commmunity </h1>  
          
        </div>
        <div class="modal-body">';
	$servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
      $imagename=array();
      $f=" ";
	  $name=" ";
	  $fi=0;
	  $fj=0;
$file = "SELECT * FROM users WHERE userEmail!='$mail'";

$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
	    $fi++;
        $m=$r["userEmail"];
		$name=$r["userName"];
		$fu = "SELECT imagename FROM images WHERE userEmail='$m' AND spec='propic' ";

		$r1= $conn->query($fu);
		if (mysqli_num_rows($r1) > 0) {
        while($r2 = $r1->fetch_assoc()) {
        $f=$r2["imagename"];
echo '<div class="col-sm-4"><div class="panel panel-default">
<img src="images/';
echo $f;
echo '" class="img-circle" style="display: block;
    margin: auto;" alt="';
echo $m;
echo '" width="80" height="80"><h4 style="text-align: center;">';
echo $name;
echo'</h4></div></div>';


 
     }
}	

     }
}

?>
