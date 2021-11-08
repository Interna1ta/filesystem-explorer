<?php

require_once("./directorymanage.php");

session_start();
// $newDirectoryName = 'new-folder-5';
// $folderName = 'files';

$newDirectoryName = $_POST["createDirectory"];
$folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';

createDirectory($newDirectoryName, $folderName);
