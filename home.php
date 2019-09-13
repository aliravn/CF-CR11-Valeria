<?php
	ob_start();
	// session_start();
	require_once 'db_connect.php';

	// if( !isset($_SESSION[ 'user' ]) ) {
	// 	header("Location: index.php");
	// 	exit;
	// }

	// $res=mysqli_query($conn, "SELECT * FROM customer WHERE customer_id=".$_SESSION['user']);
	// $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Intergalactic Library</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<a href="create.php"><button type="button">Add new media</button></a>

<table  border="1" cellspacing= "0" cellpadding="0">
	<thead>
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Cover</th>
			<th>Summary</th>
			<th>Date Published</th>
			<th>Publisher</th>
			<th>Media Type</th>
			<th>Availability</th>
			<th>Manipulate</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql_request = "SELECT media_lib_ID, isbn_code, title, concat(first_name, ' ', last_name) as author, cover_image, short_description, publish_date, name, media_type, media_status FROM media JOIN authors ON authors.author_ID = media.fk_author JOIN publishers ON publishers.publisher_ID = media.fk_publisher";
		$result = $connect->query($sql_request); 

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo  
				"<tr>
					<td>" .$row['isbn_code']."</td>
					<td>" .$row['title']."</td>
					<td>" .$row['author']."</td>
					<td>
						<img class='img-thumbnail img-fluid' src=" .$row['cover_image']." alt='some image'/>
						</td>
					<td>" .$row['short_description']."</td>
					<td>" .$row['publish_date']."</td>
					<td>" .$row['name']."</td>
					<td>" .$row['media_type']."</td>
					<td>" .$row['media_status']."</td>
				<td>
					<a href='update.php?id=" .$row['media_lib_ID']."'><button type='button'>Edit</button></a>
					<a href='delete.php?id=" .$row['media_lib_ID']."'><button type='button'>Delete</button></a>
					<a href='show_media.php?id=" .$row['media_lib_ID']."'><button type='button'>Show Media</button></a>
				</td>
				</tr>" ;
			}
		} else  {
			echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
		}
		?>
	</tbody>
</table>



</body>
</html>

<?php ob_end_flush(); 
$connect->close();
?>

