<?php session_start(); ?>

<?php

$_SESSION['uEmail'] = null;

header("Location: login.php");
?>