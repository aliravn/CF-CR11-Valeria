<!-- register.php: this file contains a simple html form with all the required registration fields except user id because it’s auto incremented and some php code for registering a new user. All the user registration process can be done in this single php file. -->

<?php
////starting a buffer and starting a session

  ob_start(); //it creates a buffer that will store all output. Output buffering is a way to tell PHP to hold some data before it is sent to the browser.

  session_start(); // start a new session or continues the previous. Starting a session requires calling the PHP function session_start before any HTML has been output.

  if( isset($_SESSION['user'])!="" ){ //if the user is loged in (user not empty)
   header("Location: home.php" ); // it redirects to home.php
  }

  include_once 'dbconnect.php';
  $error = false;
  
  if ( isset($_POST['btn-signup']) ) { //when a form is submitted to a php url via the http 'post' method , the named values in that form are added to $_POST with their respective names as keys. this line checks if the php document received a value named 'btn-signup' (see button down)

// sanitize user input to prevent sql injection
  $name = trim($_POST['name']);//trim - strips whitespace (or other characters) from the beginning and end of a string
  $name = strip_tags($name);// strip_tags — strips HTML and PHP tags from a string
  $name = htmlspecialchars($name);// htmlspecialchars converts special characters to HTML entities

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

////validate username, email and password

  // basic name validation
  if (empty($name)) {
    $error = true ;
    $nameError = "Please enter your full name.";
  } else if  (strlen($name) < 3) {
    $error = true;
    $nameError = "Name must have at least 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
    $error = true ;
    $nameError = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;
    $emailError = "Please enter valid email address." ;
  } else {
  // checks whether the email exists or not
    $query = "SELECT customer_email FROM customer WHERE customer_email='$email'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if($count!=0){
      $error = true;
      $emailError = "Provided Email is already in use.";
    }
  }
 // password validation
  $uppercase = preg_match('@[A-Z]@', $pass);
  $lowercase = preg_match('@[a-z]@', $pass);
  $number = preg_match('@[0-9]@', $pass);
  
  // $specialChars = preg_match('@[^\w]@', $password);
  if (empty($pass)){
    $error = true;
    $passError = "Please enter password.";
  } else if(!$uppercase || !$lowercase || !$number || strlen($pass) < 10) {
    $error = true;
    $passError = "Password should be at least 10 characters long and has at least 1 number, 1 capital letter";
  }

  // password hashing for security
  $password = hash('sha256', $pass);
  
//if there's no error, continue to signup
  if( !$error ) {
    $query = "INSERT INTO customer(customer_email, user_name, user_pass, user_role) VALUES('$email', '$name','$password', '0')";
    $res = mysqli_query($conn, $query); //The mysqli_query() function performs a query against the database.
 
    if ($res) {
      $errTyp = "success";
      $errMSG = "Successfully registered, you may login now";
      unset($name);
      unset($email);
      unset($pass);
      } else {
       $errTyp = "danger";
       $errMSG = "Something went wrong, try again later..." ;
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login & Registration System</title>
    <link rel="stylesheet"  href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

 

     <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
        
        <h2>Sign Up.</h2>

        <hr/>
        
        <?php if ( isset($errMSG) ) { ?>
            <div  class="alert alert-<?php echo $errTyp ?> ">
              <?php echo $errMSG; ?>
            </div>
        <?php } ?>

        <input type ="text"  name="name"  class ="form-control"  placeholder ="Enter Name"  maxlength ="50"   value = "<?php echo $name ?>" />
 
        <span   class = "text-danger" > <?php   echo  $nameError; ?> </span>
     
        <input   type = "email"   name = "email"   class = "form-control"   placeholder = "Enter Your Email"   maxlength = "40"   value = "<?php echo $email ?>"/>

        <span   class = "text-danger" > <?php   echo  $emailError; ?> </span>
 
        <input   type = "password"   name = "pass"   class = "form-control"   placeholder = "Enter Password"   maxlength = "15"/>
        <p>Password: min. 10 characters, 1 number, 1 capital letter</p>
        <span   class = "text-danger" > <?php   echo  $passError; ?> </span>
 
        <hr/>

        <button class="btn btn-primary" type = "submit" class = "btn btn-block btn-primary" name = "btn-signup">Sign Up</button >
        
        <hr/>
     
        <a href = "index.php" class="btn btn-danger" >Sign in Here...</a>
     
     </form >
  </body >
</html >
<?php  ob_end_flush(); ?>