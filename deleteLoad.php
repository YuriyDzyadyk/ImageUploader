<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdb";

if(empty($_REQUEST['file'])){
	echo "Please select the file.";
}else{



if(isset($_REQUEST['delete'])){
	foreach($_REQUEST['file']as $name){
		
		$file = 'uploads'.'/'.$name;
				if(isset($file)){
			if(unlink($file)){
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
			if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "DELETE FROM fileData
WHERE name='$name';";

if (mysqli_query($conn, $sql)) {
  //  echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
			echo "File deleted successfuly ";
			header('Location:index.php');
			// Create connection
		
			}else{
				//echo "Can not delete file";
			}
			
		}
		
	}
}


if(isset($_REQUEST['download'])){
	foreach($_REQUEST['file'] as $name){
		$file = 'uploads'.'/'.$name;
		if(file_exists($file) && is_readable($file)){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit();
		}else{
				//echo "Can not download file";
			}
			
		}
		
	}
}

?>