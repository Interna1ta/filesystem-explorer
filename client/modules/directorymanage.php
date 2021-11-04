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

function deleteDirectory($old)
{
  if (strpos($old, '/') !== false) {
    $dir = explode("/", $old);

    if (is_dir("../files/$dir[0]/$dir[1]")) {
      rmdir("../files/$dir[0]/$dir[1]");
    } else {
      unlink("../files/$dir[0]/$dir[1]");
    }
    header("Location: ../dashboard.php");
  } else {
    if (is_dir("../files/$old")) {
      rmdir("../files/$old");
    } else {
      unlink("../files/$old");
    }
    header("Location: ../dashboard.php");
  }
}

function renameDirectory($old, $new)
{

  if (strpos($old, '/') !== false) {
    $dir = explode("/", $old);

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
