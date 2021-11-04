<?php

function createDirectory($folderName = "files", $newDirectoryName)
{

  $dir = './' . $folderName . '/' . $newDirectoryName;

  if (!file_exists($dir)) {
    mkdir($dir);

    // Give permissions to the file.
    chmod($dir, 0777);
  } else {
    echo 'directory already exists';
  }
}

function openDirectory()
{

  $userDirectory = "../client/files";

  $data =  scandir($userDirectory);

  return $data;
}

function uploadDirectory($urlDirectory)
{
}

function deleteDirectory($urlDirectory)
{
}

function renameDirectory($old, $new)
{

  if (file_exists("../files/$old")) {
    rename("../files/$old", "../files/$new");
  }

  header("Location: ../dashboard.php");
}

function filterDirectories()
{
}
