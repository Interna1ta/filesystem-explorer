<?php

require_once("./directorymanage.php");

session_start();

$oldName = $_POST["delDirName"];

deleteDirectory($oldName);
