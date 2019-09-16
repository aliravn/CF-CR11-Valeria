<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];
	$sql_request = "SELECT media.isbn_code, media.title, concat(first_name, ' ', last_name) as author FROM media JOIN authors ON authors.author_ID = media.fk_author WHERE fk_publisher = '$id'";
	$result = $connect->query($sql_request); 

	$sql_publisher = "SELECT publishers.name FROM publishers WHERE publisher_ID = '$id'";
	$result_publisher = $connect->query($sql_publisher); 
	$publisher_name = $result_publisher->fetch_assoc();

	$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Media by Publisher</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="publisher-page">
		<h3>List of Media published by <span><?php echo $publisher_name['name'] ?></span></h3>
		<?php 
		$count = 1;
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo  
				"<div>$count. <strong>" .$row['title']."</strong> by ".$row['author']."</div>" ;
				$count++;
			}
		} else {
			echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
		}
		?>
		<div class="publisher-button-container">
			<a class="publisher-page-button" href= "index.php"><button type="button">Back</button></a>
		</div>
	</div>

</body>
</html>

<?php
}
?>