<?php 
require_once 'db_connect.php';

if ($_GET['id']) {
	$id = $_GET['id'];

	$sql_request = "DELETE FROM media WHERE media_lib_ID = '$id'" ;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Confirmation</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<?php	
	if($connect->query($sql_request) === TRUE) {
		echo "
		<div class='confirmation-message delete'>
			<p>Record successfully deleted from the library</p>
			<a href='./index.php'><button type='button'>Go Home</button></a>
		</div>		
		";
	} else {
		echo "Error while updating record : ". $connect->error;
	}

$connect->close();

}
?>