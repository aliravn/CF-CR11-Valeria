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
</head>

<body>
	<fieldset>
		<legend>Do you really want to delete this media item?</legend>
			<table  cellspacing="0" cellpadding= "0">		
				<tr>
					<th>Title</th>
					<td><?php echo $data['title'] ?></td>
				</tr>
				<tr>
					<th>Author</th>
					<td><?php echo $data['author'] ?></td>
				</tr>
					<td><a href="a_delete.php?id=<?php echo $data['media_lib_ID']?>" /><button class='home-manipulate-button' type='button'>Yes, get rid of it!</button></a></td>
					<td><a href= "home.php"><button type="button">No, it was a mistake!</button></a></td>

				</tr>
			</table>
	</fieldset>

</body>
</html>

<?php
}
?>

