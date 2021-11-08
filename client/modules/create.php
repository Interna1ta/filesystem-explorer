
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$rootPath = '../files';
$currentPath = $_SESSION['path'];
$newFolder = $_POST['createFolderInput'];

if ($currentPath == NULL) {
    $actualPath = getcwd();
    chdir($rootPath);
    $actualPath = getcwd();
    echo $actualPath . "\\" . $newFolder;

    if (!is_dir($newFolder)) {
        mkdir($actualPath . "\\" . $newFolder, 0777);
    }
} else {
    chdir($currentPath);
    $actualPath = getcwd();
    echo $actualPath;
    if (!is_dir($newFolder)) {
        mkdir($actualPath . "\\" . $newFolder, 0777);
    }
}
header('Location: ../dasboard.php');
?>