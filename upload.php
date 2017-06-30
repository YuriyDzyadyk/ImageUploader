<?php
//phpinfo();

    $file = $_FILES['file_upload'];
var_dump($file);
$upload='uploads';
$name = $file['name'];
//save file with its original name
$final_destination = $upload.'/'.$name;

$type =$file['type'];
$tmp_location = $file['tmp_name'];


$error = $file['error'];
$max_upload_size = 52428800;
$size = $file['size'];

//$allowedImageTypes = array('image/png', 'image/jpeg','image/gif','image/jpg');

function imageTypeAllowed($imageType){
	global $allowedImageTypes;
	if(in_array($imageType, $allowedImageTypes)){
	return true;
	}else{
	return false;
	}
}

//check for errors
if($error>0 || is_array($error)){
	die("Sorry an error occured");
}
if($size>$max_upload_size){
	die("Sorry, file type is too big (bigger than 50MB)");
}
//check if file is image
//Only required if img is only
//if(!getimagesize($tmp_location)){
//	die("Sorry, you can only upload image types");
//}
//if(!imageTypeAllowed($type)){
//	die("Sorry, fie type is not allowed");
//}
if(file_exists($final_destination)){
	die("Sorry that file already exists");
}
if(!move_uploaded_file($tmp_location, $final_destination)){
	die("Cannot finish upload, something went wrong");
}

?>


<?php
header('Location:index.php');
echo"<h2>File successfully uploaded</h2>";
?>
