<?php
 $id=$_POST['id'];
 $o=$_POST['operation'];
 $uid=$_POST['uid'];
 $love=0;
 $servername = "localhost";
      $username = "jishnutheindian";
      $password = "jishnu9345";
      $dbname = "dataentry";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }
		$f = "SELECT loves FROM timeline WHERE num='$id'";
		$r1= $conn->query($f);
		if (mysqli_num_rows($r1) > 0) {
      while($row = $r1->fetch_assoc()) {
		   $love=$row["loves"];
        if($o=="i")
		{
       
		$f2 = "INSERT INTO likes(uid,tid) VALUES('$uid','$id')";
        $r2= $conn->query($f2);
          }

           
		else
		{
		$f2 = "DELETE FROM likes WHERE uid='$uid'AND tid='$id'";
        $r2= $conn->query($f2);
		 }
	}
   }
if($o=="i")
{$love++;}
else
{$love--;}

$f = "UPDATE timeline SET loves='$love' WHERE num='$id'";
if($conn->query($f))
{echo 'works';}
		
?>