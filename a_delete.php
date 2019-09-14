<?php 
require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];

	$sql_request = "DELETE FROM media WHERE media_lib_ID = '$id'" ;
	if($connect->query($sql_request) === TRUE) {
		echo "<p>Record successfully deleted from the library</p>";
		echo "<a href='./index.php'><button type='button'>Home</button></a>";
	} else {
		echo "Error while updating record : ". $connect->error;
	}

$connect->close();

}
?>