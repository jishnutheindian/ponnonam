<?php
$email=$_GET['id'];
echo'<div class="modal-header"><h1 style="align:right">'.$email.'</h1>  
          <h2 class="modal-title">Upload your profile picture</h2>
        </div>
        <div class="modal-body">
<form action="uploadpro.php?id='.$email.'" method="post" enctype="multipart/form-data">    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
</div>';
?>