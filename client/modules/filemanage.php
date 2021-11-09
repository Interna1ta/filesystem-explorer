<?php

require_once("./modules/utils.php");

function getFiles($folderName = "files")
{
    $folderPath = getFolderPath($folderName);
    $filesAndDirs = array_diff(scandir($folderPath), array('.', '..', '.DS_Store'));

    $files = array();
    $i = 0;

    foreach ($filesAndDirs as $file) {
        $filePath = './' . $folderPath . '/' . $file;
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (is_file($filePath)) {
            $files[$i]['type'] = $fileType;
            $files[$i]['icon'] = getIcon($fileType);
            $files[$i]['url'] = $folderName;
            $files[$i]['name'] = $file;
            $files[$i]['file-size'] = formatSizeUnits(filesize($filePath));
            $files[$i]['last-modified'] = date("M d, Y", filemtime($filePath));
        }

        $i += 1;
    }

    return $files;
}

function getRootPath()
{
    getcwd();
    chdir("./");
    return getcwd() . "/";
}

function createFile($newFileName, $folderName = "files", $fileContent = "", $fileExtension = "txt")
{
    try {
        $filename = './' . $folderName . '/' . $newFileName . '.' . $fileExtension;

        // Give permissions to the file.
        chmod($filename, 0777);

        // Now the file is created, but it's empty.
        $file = fopen($filename, "wb");

        // Add new content to the file
        fwrite($file, $fileContent);

        // Close the file buffer
        fclose($file);
    } catch (Throwable $t) {
        echo $t->getMessage();
    }
}

function openFile($newFileName, $folderName = "files", $fileExtension = "txt")
{
    try {
        $fileName = "./" . $folderName . '/' . $newFileName . '.' . $fileExtension;

        if (!file_exists($fileName)) {
            throw new Exception('File open failed');
        }

        // The function returns a pointer to the file if it is successful or zero if it is not. Files are opened for read or write operations.
        $file = fopen($fileName, "r");

        // Reads the file
        $content = fread($file, filesize($fileName));

        echo $content;

        // Close the file buffer
        fclose($file);
    } catch (Throwable $t) {
        echo $t->getMessage();
    }
}

function deleteFile($folderName, $newFileName, $fileExtension)
{
    $fileName = "./" . $folderName . '/' . $newFileName . '.' . $fileExtension;

    if (file_exists($fileName)) {
        unlink($fileName);
    } else {
        echo 'File deleted';
    }
}

function renameFile($urlFile)
{
}

function filterFiles()
{
}

function getPathContent($path)
{
    $files = array();
    if ($gestor = opendir($path)) {
        while ($archivo = readdir($gestor)) {
            if ($archivo != '.' && $archivo != '..' && $archivo != '.DS_Store') {
                $files[] = $archivo;
            }
        }
        closedir($gestor);
    }
    return $files;
}
