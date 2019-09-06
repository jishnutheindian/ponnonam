<?php
$mail=$_GET['id'];
 $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
echo '<div class="modal-header"><h1 style="align:right"> Album </h1>  
          <h2 class="modal-title">'.$mail.'</h2>
        </div>
        <div class="modal-body">';

      
     
       
$wtf= "SELECT imagename FROM images WHERE userEmail='$mail'";
$foooo= $conn->query($wtf);
$num=0;
if (mysqli_num_rows($foooo) > 0) {
 while($r = $foooo->fetch_assoc()) {
	    ++$num;
		$fpic=$r["imagename"];
		
		echo' <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
                  <a href="#"><img src="images/'.$fpic.'" class="img-responsive"></a></div>
                ';
		
		
	
   }
}
$wtf= "SELECT imagesrc FROM timeline WHERE usermail='$mail'";
$foooo= $conn->query($wtf);
$num=0;
if (mysqli_num_rows($foooo) > 0) {
 while($r = $foooo->fetch_assoc()) {
	    ++$num;
		$fpic=$r["imagesrc"];
		
		echo' <br><div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
                  <a href="#"><img src="images/'.$fpic.'" class="img-responsive"></a></div><br>
                ';
		
		
	
   }
}

echo'</div>';

?>

               

                 