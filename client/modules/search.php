<?php

require "./filemanage.php";
$searchQuery = $_GET["searchQuery"];

filterFiles($searchQuery);
