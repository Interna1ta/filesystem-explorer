<?php

require_once("./directorymanage.php");

session_start();

$oldName = $_GET["deleteDirName"];

deleteDirectory($oldName);
