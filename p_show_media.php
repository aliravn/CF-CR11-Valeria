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
</head>

<body>
	<fieldset>
		<legend><h1><?php echo $data['title'];?></h1></legend>
		<img class='img-thumbnail img-fluid img-size' width="100" src="<?php echo $data['cover_image'] ?>" alt='some image'/> 
		<p>Title: <?php echo $data['title'] ?></p>
		<p>Author: <?php echo $data['author'] ?></p>
		<p>ISBN: <?php echo $data['isbn_code']?></p>		
		<p>Description: <?php echo $data['short_description'] ?></p>
		<p>Availability: <?php echo $data['media_status'] ?></p>
		<button>Reserve</button>
		<a href="p_update.php?id=<?php echo $data['media_lib_ID'] ?>"><button class='home-manipulate-button' type='button'>Edit</button></a>
		<a href="p_delete.php?id=<?php echo $data['media_lib_ID'] ?>"><button class='home-manipulate-button' type='button'>Delete</button></a>
		<a href="index.php"><button type="button">Back</button></a>		
	</fieldset>

</body>
</html>

<?php
}
?>

