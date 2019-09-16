<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

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
	<title>Add Media</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="create-page">
		<h3>Add Media</h3>
		<form action="a_create.php"  method="post">
			<div class="form-group">
				<span>ISBN</span>
				<input class="form-control" type= "text" name= "isbn_code" placeholder="ISBN"/>
			</div>
			<div class="form-group">
				<span>Title</span>
				<input class="form-control" type= "text" name="title" placeholder="media title"/>
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
				<input class="form-control" type="url" name="cover_image" placeholder="enter image URL" />
			</div>
			<div class="form-group">
				<span>Description</span>
				<input class="form-control" type ="text" name= "short_description" placeholder="write short description" />
			</div>
			<div class="form-group">
				<span>Date Published</span>
				<input class="form-control" type ="text" name= "publish_date" placeholder="YYYY-MM-DD" />
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
					<option value="book">BOOK</option>
					<option value="cd">CD</option>
					<option value="dvd">DVD</option>
				</select>
			</div>
			<div class="form-group">
				<span>Availability</span>
				<select class="form-control" name= "media_status">
					<option value="available">available</option>
					<option value="reserved">reserved</option>
				</select>
			</div>
		
			<div class="create-button-container">
				<a href= "index.php"><button class="back-button" type="button">Back</button></a>
				<button type= "submit">Add to Library</button>
			</div>
		</form>
	</div>
</body>
</html>