<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uEmail']){
}
else {
  header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>Welcome to the app</h1>
</body>
</html>