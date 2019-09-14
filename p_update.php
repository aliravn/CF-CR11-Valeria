<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];
	$sql_request = "SELECT * FROM media WHERE media_lib_ID = '$id'";
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

	$sql_publisher = "SELECT * FROM publishers";
	$result = $connect->query($sql_publisher); 
	$publisher_list = [];
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$publisher_list[$row['publisher_ID']] = $row['name'];
		}	
	}

	$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
   <title>Edit/Update media</title>
</head>

<body>
	<fieldset>
		<legend><?php echo $data['title'];?></legend>
		<form action="a_update.php"  method="post">
			<table  cellspacing="0" cellpadding= "0">
				<tr>
					<td><input type ="hidden" name= "media_lib_ID" value= "<?php echo $data['media_lib_ID'] ?>" /></td>
				</tr>
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
						<select name="fk_author">
						<?php foreach($author_list as $author_ID=>$author_name) {
							if($data['fk_author']==$author_ID) {
								echo "<option value=$author_ID selected>$author_name (current value)</option>";
							} else {
								echo "<option value=$author_ID>$author_name</option>";
							}
						}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<th>Cover Image Link</th>
					<td><input type="url" name="cover_image" value= "<?php echo $data['cover_image'] ?>" /></td>
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
					<td>
						<select name="fk_publisher">
						<?php foreach($publisher_list as $publisher_ID=>$publisher_name) {
							if ($data['fk_publisher']==$publisher_ID) {
								echo "<option value=$publisher_ID selected>$publisher_name (current value)</option>";
							} else {
								echo "<option value=$publisher_ID>$publisher_name</option>";
							}	
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Media Type</th>
					<td>
						<select name= "media_type">
							<option value="book">BOOK</option>
							<option value="cd">CD</option>
							<option value="dvd">DVD</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Availability (available/reserved)</th>
					<td><input type ="text" name= "media_status" value= "<?php echo $data['media_status'] ?>" /></td>
				</tr>				
				<tr>
					<td><button  type= "submit">Save changes</button></td>
					<td><a  href= "index.php"><button type="button">Back</button></a></td>
				</tr>
			</table>
		</form>
	</fieldset>

</body>
</html>

<?php
}
?>

