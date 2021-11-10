<?php

require_once("./directorymanage.php");

session_start();
$newDirName = $_POST["moveDirName"];
$oldDirName = $_POST["oldDirName"];


moveFiles($oldName, $newName);
