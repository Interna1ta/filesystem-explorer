<?php

require_once("./modules/utils.php");

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
  $dir = './' . $folderName . '/' . $newDirectoryName;

  if (!file_exists($dir)) {
    mkdir($dir);

    // Give permissions to the file.
    chmod($dir, 0777);
  } else {
    echo 'directory already exists';
  }
}

function openDirectory($urlDirectory)
{
}

function uploadDirectory($urlDirectory)
{
}

function deleteDirectory($urlDirectory)
{
}

function renameDirectory($urlDirectory)
{
}

function filterDirectories()
{
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
