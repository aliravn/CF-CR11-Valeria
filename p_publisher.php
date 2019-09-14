<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];
	$sql_request = "SELECT media.title FROM media WHERE fk_publisher = '$id'";
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
	<h3>List of Media buplished by <span><?php echo $publisher_name['name'] ?></span></h3>
	<?php 
	$count = 1;
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo  
			"<div>$count. " .$row['title']."</div>" ;
			$count++;
		}
	} else {
		echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
	}
	?>
	<a class="publisher-page-button" href= "index.php"><button type="button">Back</button></a>


</body>
</html>

<?php
}
?>