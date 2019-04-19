 <?php
 error_reporting(E_ALL);
  ini_set('display_errors', 1);


  session_start();
  $_SESSION['message'] = '';
  
  $mysqli = new mysqli("localhost", "team13", "Mnmsolutions18!", "team13");

  if ($mysqli->connect_error) 
  {
    die("Connection failed: " . $mysqli->connect_error);
    echo "Connection still messed up";
  } 
?>
