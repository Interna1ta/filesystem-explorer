<?php

function createDirectory($folderName = "files", $newDirectoryName) {

  $dir = './' . $folderName . '/' . $newDirectoryName;

  if (!file_exists($dir)) {
      mkdir($dir);
  } else {
    echo 'directory already exists';
  }
}

function openDirectory($urlDirectory) {

}

function uploadDirectory($urlDirectory) {

}

function deleteDirectory($urlDirectory) {

}

function renameDirectory($urlDirectory) {

}

function filterDirectories() {

}
