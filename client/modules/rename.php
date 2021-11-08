<?php

require_once("./directorymanage.php");

session_start();
$newName = $_POST["newDirName"];
$oldName = $_POST["oldDirName"];


echo $newName;
echo $oldName;

renameDirectory($oldName, $newName);
