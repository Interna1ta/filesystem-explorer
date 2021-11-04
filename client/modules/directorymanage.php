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

  if (strpos($old, '/') !== false) {
    $dir = explode("/", $old);
    echo $dir[0];
    echo $dir[1];
    rename("../files/$dir[0]/$dir[1]", "../files/$dir[0]/$new");
    header("Location: ../dashboard.php");
  } else {
    rename("../files/$old", "../files/$new");
    header("Location: ../dashboard.php");
  }
}

function filterDirectories()
{
}
