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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">   
</head>

<body>
	<div class="update-page">
		<h3><?php echo $data['title'];?></h3>
		<form action="a_update.php"  method="post">
			<input type ="hidden" name= "media_lib_ID" value= "<?php echo $data['media_lib_ID'] ?>" />
			<div class="form-group">
				<span>ISBN</span>
				<input class="form-control" type= "text" name= "isbn_code" value= "<?php echo $data['isbn_code']?>" />
			</div>
			<div class="form-group">
				<span>Title</span>
				<input class="form-control" type="text"  name="title" value="<?php echo $data['title'] ?>" />
			</div>

			<div class="form-group">
			<span>Author</span>
				<select class="form-control" name="fk_author">
					<?php foreach($author_list as $author_ID=>$author_name) {
					if($data['fk_author']==$author_ID) {
						echo "<option value=$author_ID selected>$author_name (current value)</option>";
						} else {
						echo "<option value=$author_ID>$author_name</option>";
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<span>Cover Image Link</span>
				<input class="form-control" type="url" name="cover_image" value= "<?php echo $data['cover_image'] ?>" />
			</div>
			<div class="form-group">
				<span>Description</span>
				<input class="form-control" type ="text" name= "short_description" value= "<?php echo $data['short_description'] ?>" />
			</div>
			<div class="form-group">
				<span>Date Published</span>
				<input class="form-control" type ="text" name= "publish_date" value= "<?php echo $data['publish_date'] ?>" />
			</div>
			<div class="form-group">
				<span>Publisher</span>
				<select class="form-control" name="fk_publisher">
					<?php foreach($publisher_list as $publisher_ID=>$publisher_name) {
						if ($data['fk_publisher']==$publisher_ID) {
							echo "<option value=$publisher_ID selected>$publisher_name (current value)</option>";
						} else {
							echo "<option value=$publisher_ID>$publisher_name</option>";
						}	
					}
					?>
				</select>				
			</div>
			<div class="form-group">
				<span>Media Type</span>
				<select class="form-control" name= "media_type">
					<?php 
					echo "<option value=".$data['media_type']." selected>".$data['media_type']." (current value)</option>";
					// var_dump($data['media_type']);
					if ($data['media_type']=="book") {
						echo "
						<option value='dvd'>DVD</option>
						<option value='cd'>CD</option>
						";
					} else if ($data['media_type']=='cd') {
						echo "
						<option value='book'>BOOK</option>
						<option value='dvd'>DVD</option>
						";
					} else {
						echo "
						<option value='book'>BOOK</option>
						<option value='cd'>CD</option>
						";	
					}
					?>					
				</select>
			</div>
			<div class="form-group">
				<span>Availability</span>
				<select class="form-control" name="media_status">
					<?php 
					echo "<option value=".$data['media_status']." selected>".$data['media_status']." (current value)</option>";
					if ($data['media_status']=='available') {
						echo "<option value='reserved'>reserved</option>";
					} else {
						echo "<option value='available'>available</option>";	
					}
					?>
				</select>
			</div>
			<div class="update-button-container">
				<a href= "index.php"><button class = "back-button" type="button">Back</button></a>		
				<button  type= "submit">Save changes</button>
			</div>
		</form>
	</div>	
</body>
</html>

<?php
}
?>