<?php

require_once 'utils.php';

function getDirs($folderName = "files")
{
  $folderPath = getFolderPath($folderName);
  $filesAndDirs = array_diff(scandir($folderPath), array('.', '..', '.DS_Store'));
  // $urlPath = $folderName;

  $dirs = array();
  $i = 0;

  foreach ($filesAndDirs as $file) {
    $filePath = './' . $folderPath . '/' . $file;
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    if (is_dir($filePath)) {
      $dirs[$i]['type'] = $fileType;
      $dirs[$i]['icon'] = getIcon($fileType);
      $dirs[$i]['url'] = $folderName;
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
  $dir = '../' . $folderPath . '/' . $newDirectoryName;

  if (!file_exists($dir)) {
    // Create and give permissions to the file.
    mkdir($dir, 0777, true);
    chmod($dir, 0777);
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


  if (is_dir("../files/$old")) {
    $files = glob($old . '*');
    foreach ($files as $file) {
      is_dir($file) ? deleteDirectory($file) : unlink($file);
    }
    rmdir($old);

    return;
  } else {
    unlink("../files/$old");
  }



  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function renameDirectory($oldName, $newName, $route)
{

  rename("../files/$oldName", "../files/$route/$newName");



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

function moveFiles($directoryPath, $fileToMove, $completeRoute)
{


  echo "Directory Path: $directoryPath";
  echo "File to Move: $fileToMove";
  echo "Route: $completeRoute";

  rename("../files/$completeRoute", "../files/$directoryPath/$fileToMove");



  // Generate all the folders but hide them in a retrievable menu, So it only shows the main folder unless you click on the menu which will reveal more folders underneath. WORK ON IT.

  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
