<?php

require_once 'utils.php';

function getDirs($folderName = "files")
{
  $folderPath = getFolderPath($folderName);
  $filesAndDirs = array_diff(scandir($folderPath), array('.', '..', '.DS_Store'));

  $dirs = array();
  $i = 0;

  foreach ($filesAndDirs as $file) {
    $filePath = $folderPath . '/' . $file;
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    if (is_dir($filePath)) {
      $dirs[$i]['type'] = $fileType;
      $dirs[$i]['icon'] = getIcon($fileType);
      $dirs[$i]['url'] = $filePath;
      $dirs[$i]['name'] = $file;
      $dirs[$i]['file-size'] = formatSizeUnits(filesize($filePath));
      $dirs[$i]['last-modified'] = date("M d, Y", filemtime($filePath));
    }

    $i += 1;
  }

  return $dirs;
}

function createDirectory($newDirectoryName, $folderName = "files")
{
  $folderPath = getFolderPath($folderName);
  $dir = $folderPath . '/' . $newDirectoryName;

  echo $dir;

  if (!file_exists($dir)) {
    // Create and give permissions to the file.
    mkdir($dir, 0777, true);

    echo 'yes dir';
  } else {
    echo 'directory already exists';
  }

  header("Location: ../dashboard.php");
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
  } else {
    if (is_dir("../files/$old")) {
      rmdir("../files/$old");
    } else {
      unlink("../files/$old");
    }
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function renameDirectory($oldName, $newName)
{
  if (strpos($oldName, '/') !== false) {
    $dir = explode("/", $oldName);

    rename("../files/$dir[0]/$dir[1]", "../files/$dir[0]/$newName");
  } else {
    rename("../files/$oldName", "../files/$newName");
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function getCreationDate($file)
{
  if (file_exists($file)) {
    return date("d/m/Y", filectime($file));
  } else {
    echo "n/a";
  }
}

function getSize($file)
{
  if (file_exists($file)) {
    $fileSize = ((int)filesize($file));
    if ($fileSize < 1024) {
      return $fileSize . " bytes";
    } else if ($fileSize < 1048576) {
      return round($fileSize / 1024, 2) . " KB";
    } else if ($fileSize <= 10485760) {
      return round($fileSize / 1048576, 2) . " MB";
    } else {
      return "File too big";
    }
  }
}
