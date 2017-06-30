<!DOCTYPE html>
<html>
<head>
<title>PHP file uploader</title>
<style>
body{
	margin: 30px;
	background-color: #f3eb92;
}
form {
	width: 400px;
	margin: 100px auto;
}

table {
	margin-top: 20px;
    font-family: arial, sans-serif;
   background-color: #c2a4de;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="upload.php">
<input type="hidden" name="MAX_FILE_SIZE" value = "52428800"/>
<label for="">File:<input type="file" name="file_upload"/></label>
<input type="submit" value="Upload"/>
</form>
	<h2>Files</h2>
	
<table border="1">
  <thead>
  <tr>
    <th>File Name</th>
    <th>Size (Byte)</th>
    <th>Upload time</th>
	<th>Select</th>
</tr>
  </thead>
  

<form action="deleteLoad.php" method="get">		
<?php
//phpinfo();


$handle = opendir('uploads'); 

		while($entry = readdir($handle)){
		if($entry!='.'&& $entry!='..'){
		$dirArray[]=$entry;
		}
		}
		closedir($handle);
		$indexCount=count($dirArray);
for ($index=0; $index<$indexCount; $index++){
	$name=$dirArray[$index];
	$path = 'uploads'.'/'.$name;
    if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }
	$modTime = date("Y-m-d H:i:s", filemtime($path));
	$size = filesize($path);

	echo"<tr><th> <a href=\"uploads/$name\">$name</a></th>
	<th> $size</th>
	<th> $modTime</th>
	<th><input type='checkbox' value='$name' name='file[]'/> </th>
	</tr>
	";
	
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "phpDB";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT IGNORE INTO fileData (name, date_time, size)
VALUES ('$name', '$modTime', '$size')";

if (mysqli_query($conn, $sql)) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
}	
	

?>
<input type="submit" name="delete" value="Delete"/>
<input type="submit" name="download" value="Download"/>
</form>

</table>



</body>
</html>