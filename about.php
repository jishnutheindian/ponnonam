<?php
$email=$_GET['id'];
$servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
      $fi=$f=" ";
$r;
$file = "SELECT userName,mob,dob FROM users WHERE userEmail='$email'";
$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
         echo'	<div class="modal-header"><h1 style="align:right"> about </h1>  
          <h4 class="modal-title"><h2>'.$email.'</h2></h4>
        </div>
        <div class="modal-body">
		         <h4 style="align:right">User Name:</h4><h5 style="align:left">'.$r['userName'].'</h5>
                  <h4 style="align:right">User Mail:</h4><h5 style="align:left">'.$email.'</h5>
				   <h4 style="align:right">Mobile No:</h4><h5 style="align:left">'.$r['mob'].'</h5>
		         <h4 style="align:right">Date of Birth:</h4><h5 style="align:left">'.$r['dob'].'</h5>
        </div>
      
';
     }
}


?>