<?php

require_once("./directorymanage.php");

session_start();

$newName = $_POST["newDirName"];
$oldName = $_POST["oldDirName"];

echo $_PATH;


renameDirectory($oldName, $newName);
