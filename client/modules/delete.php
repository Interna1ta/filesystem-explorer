<?php

require_once("./directorymanage.php");

session_start();

$dir = $_GET["deleteDirName"];

deleteDirectory($dir);
