<?php

require_once("./directorymanage.php");

session_start();
$newName = $_POST["moveDirName"];
$oldName = $_POST["oldDirName"];


moveFiles($oldName, $newName);
