<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];
	$sql_request = "SELECT media.*, publishers.name, concat(authors.first_name, ' ', authors.last_name) as author FROM media JOIN authors ON authors.author_ID = media.fk_author JOIN publishers ON publishers.publisher_ID = media.fk_publisher WHERE media_lib_ID = '$id'";
	$result = $connect->query($sql_request); 
	$data = $result->fetch_assoc();

	$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Media Details</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">   
</head>

<body>
	<div class="show-media-page">
		<img class='img-thumbnail img-fluid img-size' width="100" src="<?php echo $data['cover_image'] ?>" alt='some image'/> 
		<p><strong>Title: </strong><?php echo $data['title'] ?></p>
		<p><strong>Author: </strong><?php echo $data['author'] ?></p>
		<p><strong>ISBN: </strong><?php echo $data['isbn_code']?></p>		
		<p class="desctiption"><strong>Description: </strong><?php echo $data['short_description'] ?></p>
		<p><strong>Availability: </strong><?php echo $data['media_status'] ?></p>
		<div class="show-media-button-container">		
			<a href="index.php"><button type="button">Back</button></a>
			<a href="p_update.php?id=<?php echo $data['media_lib_ID'] ?>"><button class='home-manipulate-button' type='button'>Edit</button></a>
			<a href="p_delete.php?id=<?php echo $data['media_lib_ID'] ?>"><button class='home-manipulate-button' type='button'>Delete</button></a>
			<button>Reserve</button>
		</div>	
	</div>

</body>
</html>

<?php
}
?>

