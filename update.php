<!-- File 5: Update form (file: update.php)
File update.php (update.php) contains an HTML form to update the user’s data, but before we update user’s data we need to display existing data for the selected user. -->

<?php 

require_once 'db_connect.php';

if ($_GET['id']) {
   
   $id = $_GET['id'];

   $sql_request = "SELECT media_lib_ID, isbn_code, title, concat(first_name, ' ', last_name) as author, cover_image, short_description, publish_date, name, media_type, media_status FROM media JOIN authors ON authors.author_ID = media.fk_author JOIN publishers ON publishers.publisher_ID = media.fk_publisher WHERE media_lib_ID = '$id'";
   // var_dump($sql_request);
   $result = $connect->query($sql_request); 

   $data = $result->fetch_assoc(); 

   $connect->close(); 

?>

<!DOCTYPE html>
<html>
<head>
   <title><?php echo $data['title'];?></title>
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

	   <legend>Summary of your booking</legend>

	   <form action="a_update.php"  method="post">
	       <table  cellspacing="0" cellpadding= "0">
	           <tr>
	               <th>CarRegNo</th>
	               <td><input type= "text" name= "registration_num" value= "<?php echo $data['registration_num']?>" readonly /></td>
	           </tr>	       	
	           <tr>
	               <th>DailyRate</th>
	               <td><input type="text"  name="daily_rate" value="<?php echo $data['daily_rate'] ?>" readonly /></td>
	           </tr>    

	           <tr>
	               <th>CarModel</th>
	               <td><input type ="text" name= "model_name" value= "<?php echo $data['model_name'] ?>" readonly /></td >
	           </tr>
	           <tr>
	               <td><button  type= "submit">Book</button></td>
	               <td><a  href= "index.php"><button type="button" >Back</button ></a></td>
	           </tr>
	       </table>
	   </form>

	</fieldset>

</body >
</html >

<?php
}
?>