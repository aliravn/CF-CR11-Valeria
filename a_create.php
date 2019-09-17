<?php 
require_once 'db_connect.php';

if ($_POST) {
	$media_isbn = $_POST['isbn_code'];
	$media_title = $_POST['title'];
	$media_author = $_POST['fk_author'];
	$media_image = $_POST['cover_image'];
	$media_description = $_POST['short_description'];
	$media_publishdate = $_POST['publish_date'];
	$media_publisher = $_POST['fk_publisher'];
	$media_type = $_POST['media_type'];
	$media_status = $_POST['media_status'];

	$sql_request = "INSERT INTO media (`isbn_code`, `title`, `fk_author`, `cover_image`, `short_description`, `publish_date`, `fk_publisher`, `media_type`, `media_status`) VALUES ('$media_isbn', '$media_title', '$media_author', '$media_image', '$media_description', '$media_publishdate', '$media_publisher', '$media_type', '$media_status')";
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
			<p>Record has beed successfully added to the library</p>
			<a href='p_create.php?id=$id'><button type='button'>Add more</button></a>
			<a href='index.php'><button type='button'>Go Home</button></a>
		</div>
		";
	} else {
		echo "Error while updating record : ". $connect->error;
	}

$connect->close();

}
?>