<?php

require_once("./directorymanage.php");

session_start();

$dir = $_POST["deleteDirName"];

deleteDirectory($dir);
