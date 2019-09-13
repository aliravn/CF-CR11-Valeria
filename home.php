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
 
	   <!-- <a href="create.php"><button type="button">Book car</button></a> -->
	   
	   <table  border="1" cellspacing= "0" cellpadding="0">
		   <thead>
			   <tr>
				   <th>CarRegNo</th>
				   <th>DailyRate</th>
				   <th>Available</th>
				   <th>CarModel</th>
				   <th>Location</th>
				   <th>Reservation</th>
			   </tr>
		   </thead>
		   <tbody>
			   <?php
			   // require_once 'dbconnect.php';
			   $sql = "SELECT cars.registration_num, cars.daily_rate, cars.availability, models.model_name,locations.location_name FROM cars JOIN locations ON locations.location_id = cars.fk_location_id JOIN models ON cars.fk_model_id = models.model_id WHERE cars.availability = 'yes'";
			   $result = $conn->query($sql); 

				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { //?? --> durch alle Einträge gehen (joh) //checking how many rows the table has and saving the value in $row. If it is null/0 it will go to else.
					   echo  "<tr>
						   <td>" .$row['registration_num']."</td>
						   <td>" .$row['daily_rate']."</td>
						   <td>" .$row['availability']."</td>
						   <td>" .$row['model_name']."</td>
						   <td>" .$row['location_name']."</td>
						   <td>
							   <a href='update.php?id=" .$row['registration_num']."'><button type='button'>Book</button></a>
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

<?php ob_end_flush(); ?>

