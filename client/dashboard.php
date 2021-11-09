<?php
error_reporting(E_ALL ^ E_NOTICE);

session_start();


if (!isset($_SESSION['name'])) {
    header('Location: ./index.php');
}

require_once("./modules/utils.php");
require_once("./modules/filemanage.php");
require_once("./modules/directorymanage.php");

$rootPath = getRootPath();
$baseUrl = getBaseUrl();

// $newDirectoryName = 'best-folder';
// $folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';

// echo $newDirectoryName;

// echo '<br />';

// echo $folderName;

// echo '<br />';

// createDirectory($newDirectoryName, $folderName);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My first Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="./node_modules/@icon/simple-line-icons/simple-line-icons.css">

    <link rel="stylesheet" href="./context-menu.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex justify-content-lg-center p-2 border-bottom">
                <a class="nav-link dropdown-toggle d-flex justify-content-lg-center align-items-center" href=" #" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mx-2 text-white sidebar-brand-text just">
                        <b><?= strtoupper($_SESSION['name']); ?></b>
                    </span>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        <a class="dropdown-item" href="./dashboard.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Home
                        </a>
                        <div class="sidebar-brand-text mx-3">

                            <!-- Nav Item - User Information -->
                            <div class="sidebar-brand-text dropdown no-arrow">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mr-2">
                        <img class="pl-auto img-thumbnail rounded-circle w-25" style="padding: 0.125rem !important;" src="img/undraw_profile.svg" />
                    </div>
                </a>
            </div>

            <!-- Nav Item - Dashboard -->
            <form action="./modules/upload.php" method="POST" enctype="multipart/form-data" class="nav-item active btn bg-white d-flex justify-content-center m-3 mr-auto align-middle" style="border-radius: 30px; padding: 0.5 rem 1rem;">
                <label for='file' class="mb-0">
                    <img class="mr-1" height="20" width="20" src="./node_modules/@icon/simple-line-icons/icons/plus.svg" />
                    New
                </label>
                <input class="d-none" type="file" name='file' id='file' onchange="form.submit()" multiple />
            </form>

            <button type="button" class="btn btn-secondary item" data-toggle="modal" data-target="#createDirModal">
                <img class="mr-1" height="20" width="20" src="./node_modules/@icon/simple-line-icons/icons/folder.svg" />
                Folder
            </button>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <img class="mr-1" height="16" width="16" src="./node_modules/@icon/simple-line-icons/icons/folder.svg" />
                    <span>Bin</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-white">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light border-bottom topbar static-top px-2">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small py-2 px-3" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid p-0">

                    <!-- Content Row -->
                    <div class="row text-gray-900 pt-4 pb-2 px-3 m-0 text-center border-bottom">
                        <div class="col col-6 d-flex">Name</div>
                        <div class="col col-3 d-flex">Last modified</div>
                        <div class="col col-3 d-flex">File Size</div>
                    </div>

                    <?php
                    $folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';
                    $dirs = getDirs($folderName);

                    foreach ($dirs as $dir) {
                    ?>
                        <button class="btn btn-light bg-white border-0 w-100 p-0  file__area" type="button" onclick="window.location.href='./dashboard.php?dir=<?= isset($_GET['dir']) ? $_GET['dir'] . '/' .  $dir['name'] :  $dir['name']; ?>'">
                            <div class="row m-0 p-3 text-center border-bottom">

                                <div class="col col-6 d-flex align-items-center ">
                                    <img class="mr-3" height="20" width="20" src="./node_modules/@icon/simple-line-icons/icons/<?= $dir['icon']; ?>" />
                                    <span class="selectedName" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $dir['name']; ?></span>
                                </div>
                                <div class="col col-3 d-flex align-items-center">
                                    <span class=""><?= $dir['last-modified']; ?></span>
                                </div>
                                <div class="col col-3 d-flex align-items-center">
                                    <span class=""><?= $dir['file-size']; ?></span>
                                </div>
                            </div>
                        </button>
                    <?php } ?>

                    <?php
                    $folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';
                    $files = getFiles($folderName);


                    foreach ($files as $file) {
                    ?>

                        <button class="btn btn-light bg-white border-0 w-100 p-0 file__area" type="button" onclick="window.location.href='<?= $file['url']; ?>'">
                            <div class="row m-0 p-3 text-center border-bottom">
                                <div class="col col-6 d-flex align-items-center ">

                                    <img class="mr-3" height="20" width="20" src="./node_modules/@icon/simple-line-icons/icons/<?= $file['icon']; ?>" />
                                    <span class="selectedName" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $file['name']; ?></span>
                                </div>
                                <div class="col col-3 d-flex align-items-center">
                                    <span><?= $file['last-modified']; ?></span>
                                </div>
                                <div class="col col-3 d-flex align-items-center">
                                    <span><?= $file['file-size']; ?></span>
                                </div>
                            </div>
                        </button>
                    <?php } ?>

                </div>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ready to Leave,<b>
                                <?php echo $_SESSION['name']; ?></b>
                            ?
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="./modules/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create the Directory/File Modal -->
        <div class="modal fade" id="createDirModal" tabindex="-1" role="dialog" aria-labelledby="createDirModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form class="modal-content" action="../client/modules/create.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Folder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="createDirectory" placeholder="Insert New Name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- Rename the Directory/File Modal -->
        <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form class="modal-content" action="../client/modules/rename.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Rename</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" readonly class="form-control-plaintext" id="oldDirName" name="oldDirName">
                        <input name="route" id="routeDirectory" readonly class="form-control-plaintext">
                        <input name="newDirName" placeholder="Insert New Name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete the Directory/File Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form class="modal-content" onsubmit="(e) => {e.preventDefault()}" action="../client/modules/delete.php" method="GET">
                    <div class="modal-header">
                        <h5>Delete File</h5>
                        <input type="text" readonly class="form-control-plaintext h5 d-none" id="deleteDirName" name="deleteDirName"></input>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure you want to delete this file?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Click Menu! -->
        <div id="context-menu" class="btn-group-mr-2">
            <button type="button" class="btn item">
                Open
            </button>
            <button type="button" class="btn item" data-toggle="modal" data-target="#renameModal">
                Rename
            </button>
            <button type="button" class="btn item" data-toggle="modal" data-target="#moveModal">
                Move
            </button>
            <button type="button" class="btn item" data-toggle="modal" data-target="#deleteModal">
                Delete
            </button>
            <button type="button" class="btn item">
                Properties
            </button>
        </div>

        <!-- Move to the Directory/File Modal -->
        <div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="moveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form class="modal-content" action="../client/modules/move.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Move File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="moveModalInput" name="oldDirName">
                        <input name="moveDirName" id="moveDirName">

                        <?php
                        $folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';
                        $dirs = getDirs($folderName);

                        foreach ($dirs as $dir) {
                        ?>
                            <button class="btn btn-light bg-white border-0 w-100 p-0" data-move="move" type="button">
                                <div class="row m-0 p-3 text-center border-bottom" data-move="move">
                                    <div class="col col-6 d-flex align-items-center " data-move="move">
                                        <img class="mr-3" height="20" width="20" src="./node_modules/@icon/simple-line-icons/icons/<?= $dir['icon']; ?>" />
                                        <span data-move="move" class="selectedName" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $dir['name']; ?></span>
                                    </div>

                                </div>
                            </button>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Move</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


        <!-- context menu -->

        <script src="../client/js/context-menu-rename.js"></script>
</body>

</html>