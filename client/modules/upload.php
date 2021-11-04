<?php

session_start();
$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpName = $file['type'];
$size = $_FILES['file']['size'];
$error = $_FILES['file']['error'];
$rootPath = '../files/';
$currentPath = $_SESSION['path'];


if ($size > 10485760 || $error > 0)
    die('Error uploading file! Please check that your file is less than 10MB.');
if ($size < 10485760 && $currentPath == NULL) {
    move_uploaded_file($file['tmp_name'], $rootPath . $fileName);
    echo $currentPath;
} else {
    chdir($currentPath);
    $actualPath = getcwd();
    echo $actualPath;
    move_uploaded_file($file['tmp_name'], $actualPath . '/' . $fileName);
}
header('Location: ../dashboard.php');
