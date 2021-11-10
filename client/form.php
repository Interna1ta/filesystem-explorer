<?php
session_start();

$path = $_GET['dir'];
$_SESSION['dir'] = $path;
header('Location: ./dashboard.php');
