<?php
session_start();
$a;
$b;
$c;
$mail=$_SESSION["usermail"];
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
	  
$file = "SELECT * FROM users WHERE userEmail!='$mail'";
$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {
 while($r = $result->fetch_assoc()) {
	   
        $m=$r["userEmail"];
		$c[$fi]=$m;
		$a[$fi]=$r["userName"];
		$fu = "SELECT imagename FROM images WHERE userEmail='$m' AND spec='propic' ";

		$r1= $conn->query($fu);
		if (mysqli_num_rows($r1) > 0) {
        while($r2 = $r1->fetch_assoc()) {
			 $b[$fi]=$r2["imagename"];
     }
}	
$fi++;
     }
	  
}

// get the q parameter from URL
$q = $_REQUEST["q"];
$m=0;
$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    for($fi=0;$fi<count($a);$fi++) {
	
        if (stristr($q, substr($a[$fi], 0, $len))) {
            if ($hint === "") {
             $m++;
               echo '<div class="col-sm-4"><div class="panel panel-default"><a href="profile.php?id='.$c[$fi].'&name='.$a[$fi].'"><img src="images/';
echo $b[$fi];
echo '" class="img-circle" style="display: block;
    margin: auto;" alt="';
echo '" width="80" height="80"><h4 style="text-align: center;">';
echo $a[$fi];
echo'</h4></div></div>';
            } else {
				$m++;
               echo '<div class="col-sm-4"><div class="panel panel-default">
<img src="images/';
echo $b[$fi];
echo '" class="img-circle" style="display: block;
    margin: auto;" alt="';
echo '" width="80" height="80"><h4 style="text-align: center;">';
echo $a[$fi];
echo'</a></h4></div></div>';
            }
		
        }
		
    }
	
}
if($m==0)
		{ echo 'No results'; }


?>