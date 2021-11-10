<?php

require_once("./directorymanage.php");

session_start();

$newDirectoryName = $_POST["createDirectory"];
$folderName = $_POST["folderName"];

createDirectory($newDirectoryName, $folderName);
