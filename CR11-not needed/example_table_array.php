<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>

	</style>

</head>
<body>
	<?php
	$employees = [
	
		"name" => array
			(
				"value1" => "Mark",
				"value2" => "Frank",
				"value3"  => "Estefania"
			),
		"age" => array
			(
				"value1" => 51,
				"value2" => 19,
				"value3"  => 23
			),
		"uniform" => array
			(
				"value1" => "Blue",
				"value2" => "Red",
				"value3"  => "Black"
			),
		"shift" => array
			(
				"value1" => "Monday",
				"value2" => "Friday",
				"value3"  => "Christmas"
			)

	];

// echo $employees["name"]["value3"] . " = t1v3, ". $employees["age"]["value2"]. " = t2v2";




// echo "<div class='table'>{$employees['name']['value1']}</div>";

// echo $employees['name']['value3'];



/* "t" => array
			(
				"" => ,
				"" => ,
				""  => 
			), */
?>
	
<table class='table'>
<thead>
<tr>
<th scope='col'>#</th>
<th scope='col'>Name</th>
<th scope='col'>Age</th>
<th scope='col'>Uniform</th>
<th scope='col'>Shift</th>
</tr>
</thead>
<tbody>
    <tr>
      <th scope='row'>1</th>
      <td><?= $employees["name"]["value1"] ?></td>
      <td><?= $employees["age"]["value1"] ?></td>
      <td><?= $employees["uniform"]["value1"] ?></td>
      <td><?= $employees["shift"]["value1"] ?></td>
    </tr>
    <tr>
      <th scope='row'>2</th>
	<!-- <?php echo $employees['name']['value2'] ?> -->
      <td><?= $employees['name']['value2'] ?></td> 
      <td><?= $employees['age']['value2'] ?></td>
      <td><?= $employees['uniform']['value2'] ?></td>
      <td><?= $employees['shift']['value2'] ?></td>
    </tr>
    <tr>
      <th scope='row'>3</th>
      <td><?= $employees['name']['value3'] ?></td>
      <td><?= $employees['age']['value3'] ?></td>
      <td><?= $employees['uniform']['value3'] ?></td>
      <td><?= $employees['shift']['value3'] ?></td>
    </tr>
  </tbody>
</table>


</body>
</html>
