<?php
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );

define ('DBHOST', 'localhost');
define('DBUSER' , 'root');
define('DBPASS', 'Deadend6!');
define ('DBNAME', 'cr11_valeria_nazarova_biglibrary');

$connect = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

if (!$connect) {
 die("Connection failed : ". mysqli_error());
}
// else {echo "connected";}
?>
