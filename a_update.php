<?php 
require_once 'db_connect.php';

if ($_POST) {
	$id = $_POST['media_lib_ID'];
	$media_isbn = $_POST['isbn_code'];
	$media_title = $_POST['title'];
	$media_author = $_POST['fk_author'];
	$media_image = $_POST['cover_image'];
	$media_description = $_POST['short_description'];
	$media_publishdate = $_POST['publish_date'];
	$media_publisher = $_POST['fk_publisher'];
	$media_type = $_POST['media_type'];
	$media_status = $_POST['media_status'];

	$sql_request = "UPDATE media SET `isbn_code` = '$media_isbn', `title` = '$media_title', `fk_author` = '$media_author', `cover_image` = '$media_image', `short_description` = '$media_description', `publish_date` = '$media_publishdate', `fk_publisher` = '$media_publisher', `media_type` = '$media_type', `media_status` = '$media_status' WHERE media_lib_ID = '$id'" ;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Confirmation</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<?php
	if($connect->query($sql_request) === TRUE) {
		echo "
		<div class='confirmation-message'>
			<p>Record successfully updated</p>
			<a href='./p_update.php?id=$id'><button type='button'>Back</button></a>
			<a href='./index.php'><button type='button'>Home</button></a>
		</div>
		";
	} else {
		echo "Error while updating record : ". $connect->error;
	}

$connect->close();

}
?>