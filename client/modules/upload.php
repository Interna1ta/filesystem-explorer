<?php

session_start();
$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpName = $file['type'];
$rootPath = '../files/';
$currentPath = $_SESSION['path'];


if ($currentPath == NULL) {
    move_uploaded_file($file['tmp_name'], $rootPath . $fileName);
    echo $currentPath;
} else {
    chdir($currentPath);
    $actualPath = getcwd();
    echo $actualPath;
    move_uploaded_file($file['tmp_name'], $actualPath . '/' . $fileName);
}

header('Location: ../dashboard.php');
