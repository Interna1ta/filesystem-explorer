<?php

require_once("./directorymanage.php");

session_start();
$newName = $_POST["newDirName"];
$oldDirectoryName = $_POST["oldDirName"];
$route = $_POST["route"];

echo "<h1>$newName</h1>";
echo "<h1>$oldDirectoryName</h1>";
echo "<h1>$route</h1>";




renameDirectory($oldDirectoryName, $newName, $route);
