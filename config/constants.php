<?php
  // Set a custom session name
  session_name('MySession');
  session_start(); // Start the session

  define('SITEURL','http://localhost/project-hub/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','project-hub');

  $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conn));
  $db_select = mysqli_select_db($conn, 'project-hub') or die(mysqli_error($conn)); 

?>