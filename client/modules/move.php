<?php

require_once("./directorymanage.php");

session_start();
$directoryPath = $_GET["directoryPath"];
$fileToMove = $_GET["fileToMove"];
$completeRoute = $_GET["completeRoute"];


moveFiles($directoryPath, $fileToMove, $completeRoute);
