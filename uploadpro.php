<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('inup.php');
}
$uid=$_SESSION["id"];
$servername = "localhost";
$username = "jishnutheindian";
$password = "jishnu9345";
$dbname = "dataentry";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
$name = $_GET["id"];



$spec= "propic";
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
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
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
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
$file = "SELECT imagename FROM images WHERE userEmail='$name' AND spec='propic' ";
$sl="UPDATE images SET spec='oldpro' WHERE userEmail='$name' AND spec='propic'";
$result= $conn->query($file);
if (mysqli_num_rows($result) > 0) {
if ($conn->query($sl) == TRUE) {
    echo "image adress added successfully";
	
} else {
    echo "Error: " . $sl . "<br>" . $conn->error;
}


     }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO images(userEmail,imagename,spec,imagetype,uid) VALUES('$name','$filename','$spec','$imageFileType','$uid')";

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