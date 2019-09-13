<?php 
	require_once 'db_connect.php';

	if ($_GET['id']) {
		$id = $_GET['id'];
		$sql_request = "SELECT media_lib_ID, isbn_code, title, concat(first_name, ' ', last_name) as author, cover_image, short_description, publish_date, name, media_type, media_status FROM media JOIN authors ON authors.author_ID = media.fk_author JOIN publishers ON publishers.publisher_ID = media.fk_publisher WHERE media_lib_ID = '$id'";
		// var_dump($sql_request);
		$result = $connect->query($sql_request); 
		$data = $result->fetch_assoc(); 


		$sql_author = "SELECT * FROM authors";
		$result = $connect->query($sql_author); 
		$author_list = [];
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$author_list[$row['author_ID']] = $row['first_name'].' '.$row['last_name'];
			}
	}
// var_dump($author_list);





$connect->close(); 

?>

<!DOCTYPE html>
<html>
<head>
   <title>Edit/Update media</title>
   <style type= "text/css">
       fieldset {
           margin : auto;
           margin-top: 100px;
           width: 50%;
       }

       table tr th {
           padding-top: 20px;
       }
   </style>

</head>
<body>

	<fieldset>
		<legend><?php echo $data['title'];?></legend>
		<form action="a_update.php"  method="post">
			<table  cellspacing="0" cellpadding= "0">
				<tr>
					<th>ISBN</th>
					<td><input type= "text" name= "isbn_code" value= "<?php echo $data['isbn_code']?>" /></td>
				</tr>
				<tr>
					<th>Title</th>
					<td><input type="text"  name="title" value="<?php echo $data['title'] ?>" /></td>
				</tr>

				<tr>
					<th>Author</th>
					<td>
						<select>
						<?php foreach($author_list as $author_ID=>$author_name) {
							echo "<option value=$author_ID>$author_name</option>";
						}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<th>Cover Image Link</th>
					<td><input type ="text" name= "cover_image" value= "<?php echo $data['cover_image'] ?>" /></td>
				</tr>				
				<tr>
					<th>Description</th>
					<td><input type ="text" name= "short_description" value= "<?php echo $data['short_description'] ?>" /></td>
				</tr>
				<tr>
					<th>Date Published</th>
					<td><input type ="text" name= "publish_date" value= "<?php echo $data['publish_date'] ?>" /></td>
				</tr>
				<tr>
					<th>Publisher</th>
					<td><input type ="text" name= "name" value= "<?php echo $data['name'] ?>" readonly /></td>
				</tr>
				<tr>
					<th>Media Type</th>
					<td><input type ="text" name= "media_type" value= "<?php echo $data['media_type'] ?>" /></td>
				</tr>
				<tr>
					<th>Availability</th>
					<td><input type ="text" name= "media_status" value= "<?php echo $data['media_status'] ?>" /></td>
				</tr>				
				<tr>
					<td><a href="a_update.php?id=<?php echo $data['media_lib_ID'] ?>"><button type='button'>Update</button></a></td>

					<td><a  href= "home.php"><button type="button">Back</button></a></td>
				</tr>
			</table>
		</form>
	</fieldset>

</body>
</html>

<?php
}
?>

