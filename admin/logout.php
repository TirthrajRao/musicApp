<?php session_start(); ?>

<?php

$_SESSION['uRole'] = null;

header("Location: ../user/login.php");
?>