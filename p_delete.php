<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];
	$sql_request = "SELECT media_lib_ID, isbn_code, title, concat(first_name, ' ', last_name) as author FROM media JOIN authors ON authors.author_ID = media.fk_author WHERE media_lib_ID = '$id'";
	$result = $connect->query($sql_request); 
	$data = $result->fetch_assoc();

	$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
   <title>Delete media</title>
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="delete-page">
		<p>Do you really want to delete this media item?</p>
		<p class="delete-remark-text">Think twice - you will not be able to reverse this action.</p>
		<p><strong>Title:</strong> <?php echo $data['title'] ?></p>
		<p><strong>Author:</strong> <?php echo $data['author'] ?><p/>
		<div class="delete-page-button-container">
			<a href="a_delete.php?id=<?php echo $data['media_lib_ID']?>" /><button type='button'>Yes, get rid of it!</button></a>
			<a href= "index.php"><button type="button">No, it was a mistake!</button></a>
		</div>
	</div>
</body>
</html>

<?php
}
?>

