<?php
session_start();
if (!isset($_SESSION['user_type']))
header('location:403error.php');
?>