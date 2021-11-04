<?php

function getFilesAndDir($folderName = "files")
{

    $folderPath = getFolderPath($folderName);

    return array_diff(scandir($folderPath), array('.', '..', '.DS_Store'));
}

function getFolderPath($folderName)
{
    if ($folderName !== 'files') {
        return $folderPath = './files/' . $folderName;
    } else {
        return $folderPath = './files';
    }
}

function getRootPath()
{
    getcwd();
    chdir("./");
    return getcwd() . "/";
}

function getArrayFilesAndDir($filesAndDir, $folderName = "files")
{

    $folderPath = getFolderPath($folderName);

    $newArray = array();
    $i = 0;

    foreach ($filesAndDir as $file) {
        $filePath = $folderPath . '/' . $file;

        $newArray[$i]['type'] = is_dir($filePath) ? 'dir' : 'file';
        $newArray[$i]['url'] = $filePath;
        $newArray[$i]['name'] = $file;
        $newArray[$i]['file-size'] = filesize($filePath);
        $newArray[$i]['last-modified'] = date("F d Y H:i:s.", filemtime($filePath));

        $i += 1;
    }

    return $newArray;
}

function createFile($folderName = "files", $newFileName, $fileContent = "", $fileExtension = "txt")
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

function openFile($folderName = "files", $newFileName, $fileExtension = "txt")
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

function uploadFile($folderName)
{

    $target_dir = "./" . $folderName . "/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "<p>File is an image - " . $check["mime"] . ".</p>";
            $uploadOk = 1;
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                echo "<p>El fichero es válido y se subió con éxito.</p>";
            } else {
                echo "<p>¡Posible ataque de subida de ficheros!</p>";
            }
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
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


function renderOnlyFolders($files)
{
    echo '<li class="nav-item">';
    echo "<form action='form.php' method='post' class=''>";
    echo "<button type='submit' name='home' class='bg-dark pl-4 nav-link btn-link collapsed' value='./'/'>";
    echo '<i class="fas fa-home"></i>';
    echo "Home";
    echo "</button>";
    echo "</form>";
    foreach ($files as $file) {
        if (is_dir($file)) {
            echo "<form action='form.php' method='post'>";
            echo "<button type='submit' name='path' class='bg-dark pl-4 nav-link btn-link collapsed' value='$file'/'>";
            echo '<i class="fas fa-folder"></i>';
            echo "$file";
            echo "</button>";
        }
    }
    echo '</li>';
    //    Divider
    echo '<hr class="sidebar-divider d-none d-md-block" />';
}

function renderAllContent($files)
{
    foreach ($files as $file) {
        echo "<div class='d-flex w-100 justify-content-between'>";
        echo "<span class='d-flex w-40 pr-4'>";
        echo "<i class='fas fa-fw fa-folder mr-2 '></i>";
        echo "<p class='w-100 mb-0'>" . $file . "</p>";

        echo "<form action='' method='POST'>";
        echo "<button class='bg-white border-0 rename' value='$file' name='rename' type='button' id='renameFileButton'><i class='far fa-edit text-right'></i></button>";
        echo '</form>';

        echo "</span>";
        echo "<p class='w-15 mb-0'>";
        echo getCreationDate($file);
        echo "</p>";
        echo "<p class='w-15 mb-0'>";

        echo "<form action='functions/deleteFiles.php' method='POST'>";
        echo '<button class="bg-white border-0" value=' . $file . ' name="trash"><i class="fas fa-trash"></i></button>';
        echo '</form>';

        echo "</span>";
        echo "</div>";
        echo '<hr class="sidebar-divider d-none d-md-block" />';
    }
}
