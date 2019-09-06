<?php
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
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
$name = $_GET["id"];
$comment = $_POST["comment"];




$url='timeline.php';
$target_dir = "E:/xampp/htdocs/ponnonam/images/";
$filename=basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir .$filename;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    
    $uploadOk = 0;
}
// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
	
}*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $sql = "INSERT INTO timeline(usermail,post,uid) VALUES('$name','$comment','$curid')";

if ($conn->query($sql) == TRUE) {
    echo "image adress added successfully";
	header("Location: $url");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// if everything is ok, try to upload file
} else {


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO timeline(usermail,imagesrc,post,uid) VALUES('$name','$filename','$comment','$curid')";

if ($conn->query($sql) == TRUE) {
    echo "image adress added successfully";
	header("Location: $url");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

		
	} else {
		
        echo "Sorry, there was an error uploading your file.";
    }
}
?> 