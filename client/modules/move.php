<?php

require_once("./directorymanage.php");

session_start();
$directoryPath = $_POST["directoryPath"];
$fileToMove = $_POST["fileToMove"];
$completeRoute = $_POST["completeRoute"];


moveFiles($directoryPath, $fileToMove, $completeRoute);
?>

<!-- Modal Window To Show Subfolders, Doesnt work right now. Creats Error with right click functionality of other elements. -->

<!-- <?php
        //$subFolderName = $dir['name'];
        //$subFolders = getDirs($subFolderName);


        // foreach ($subFolders as $subFolder) {
        ?>
    <button class="btn btn-light bg-white border-0 w-100 p-1 " data-move="move" type="button">
        <div class=" row m-0 p-3 text-center border-bottom">
            <div class="col d-flex align-items-center ">

                <img class="mr-3" height="15" width="15" src="./node_modules/@icon/simple-line-icons/icons/<?= $subFolder['icon']; ?>" />
                <span class="selectedName fs-0.5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $subFolder['name']; ?></span>
            </div>

        </div>
    </button>

<?php  ?> -->