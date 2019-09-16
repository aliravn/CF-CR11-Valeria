<!-- index.php/login: this file also contains an html form with two input boxes, which will take the user email and user password entered by the user and then after submitting the form, the php code will match the user email and password combination in the database. When it finds both results in the table then it will start a session and allow the user to access the home page, otherwise, it will show an appropriate message. -->

<?php

ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION[ 'user' ])!="" ) {
  header("Location: home.php");
  exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

// prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST[ 'pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
// prevent sql injections / clear user invalid inputs

if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
}

if (empty($pass)){
$error = true;
$passError = "Please enter your password." ;
}

// if there's no error, continue to login
if (!$error) { 
$password = hash( 'sha256', $pass); // password hashing

$res=mysqli_query($conn, "SELECT customer_id, user_name, user_pass, customer_email FROM customer WHERE customer_email='$email'" );
$row=mysqli_fetch_array($res, MYSQLI_ASSOC);
$count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row
if( $count == 1 && $row['user_pass' ]==$password ) {
$_SESSION['user'] = $row['customer_id'];
header( "Location: home.php");
} else {
$errMSG = "Incorrect Credentials, Try again..." ;
}

}

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login & Registration System</title>

  <link rel="stylesheet" href ="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"  crossorigin="anonymous">
</head>

<body>
	<form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
		<h2>Sign In</h2>
		<hr/>

	<?php
	if (isset($errMSG)) {
	  echo $errMSG;
	}
	?>

		<input 
			type="email" name="email"  
			class="form-control" 
			placeholder= "Your Email" value="<?php echo $email; ?>"  
			maxlength="40" 
		/>

		<span 
			class="text-danger">
			<?php echo $emailError; ?>
		</span>


		<input
			type="password" 
			name="pass"  
			class="form-control" placeholder ="Your Password" 
			maxlength="15"  
		/>

		<span  
			class="text-danger">
			<?php  echo $passError; ?>
		</span>

		<hr/>
		<button class="btn btn-primary" type="submit" name= "btn-login">Sign In</button>
		<hr/>

		<a  href="register.php">Sign Up Here...</a>
	</form>

</body>
</html>

<?php ob_end_flush(); ?>