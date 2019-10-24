<?php
$con = @mysqli_connect("localhost","root","root","ashish");



if(isset($_POST['sizeofform'])){ 
	for($i=0;$i<=$_POST['sizeofform'];$i++)
	{
		$name = $_POST['name'.$i];
		$email = $_POST['email'.$i];
		$gender = $_POST['gender'.$i];
		$pic = fileupload($_FILES['fileupload'.$i]);
		$ins = "INSERT INTO `users`(`name`, `email`, `gender`, `pic`) VALUES ('{$name}','{$email}','{$gender}','{$pic}')";


			if ($con->query($ins) === TRUE) {
			    //echo "New record created successfully";
			} else {
			    //echo "Error: " . $sql . "<br>" . $conn->error;
			}

			
	}
	echo "New record created successfully";
}
$con->close();


function fileupload($pic)
{
$flag = 0;
$target_dir = "uploads/";
$filename = rand(0000000000,999999999).basename($pic["name"]);
$target_file = $target_dir . $filename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($pic["tmp_name"]);
    if($check !== false) {
      //  echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
      //  echo "File is not an image.";
        $uploadOk = 0;
    }


// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($pic["size"] > 50000000) {
  //  echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($pic["tmp_name"], $target_file)) {
     //   echo "The file ". basename( $pic["name"]). " has been uploaded.";
    	$flag=$filename;
    } else {
       // echo "Sorry, there was an error uploading your file.";
    	$flag=0;
    }
}
return $flag;
}
?>