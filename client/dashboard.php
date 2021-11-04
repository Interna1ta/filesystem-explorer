<?php
error_reporting(E_ALL ^ E_NOTICE);

session_start();

if (!isset($_SESSION['name'])) {
    header('Location: ./index.php');
}

require_once("./modules/filemanage.php");
require_once("./modules/directorymanage.php");
require_once("./modules/utils.php");

$rootPath = getRootPath();
$baseUrl = getBaseUrl();

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
    <link rel="stylesheet" href="<?= $baseUrl; ?>/php-filesystem-explorer/node_modules/@icon/simple-line-icons/simple-line-icons.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex justify-content-lg-center" href="index.php">
                <a class="nav-link dropdown-toggle d-flex justify-content-lg-center" href=" #" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mx-4 text-white sidebar-brand-text just">
                        <b>HI, <?php echo strtoupper($_SESSION['name']); ?></b>
                    </span>
                    <div>
                        <img class="img-thumbnail rounded-circle w-75" src="img/undraw_profile.svg">
                    </div>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                    <div class="sidebar-brand-text mx-3">

                        <!-- Nav Item - User Information -->
                        <div class="sidebar-brand-text dropdown no-arrow">
                        </div>
                    </div>
                </div>
            </a>

            <!-- Nav Item - Dashboard -->
            <form action="./modules/upload.php" method="POST" enctype="multipart/form-data" class="nav-item active btn bg-white d-flex justify-content-center m-4 align-middle">
                <label for='file' class='btn btn-white'>
                    <i class="fa fa-plus align-middle fa-space-shuttle fa-rotate-270" aria-hidden="true"></i>
                    Upload File
                </label>
                <input class="hidden" type="file" name='file' id='file' onchange="form.submit()" />
            </form>

            <!-- Heading -->
            <div class="sidebar-heading">
                Folders
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php
            $rootFiles = getPathContent($rootPath);
            echo (renderFolders($rootFiles));
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Others
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
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
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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

                    <div class="row bg-gray-200 text-gray-900 p-3 m-0 text-center">
                        <div class="col col-6 d-flex">Name</div>
                        <div class="col col-3 d-flex">Last modified</div>
                        <div class="col col-3 d-flex">File Size</div>
                    </div>

                    <?php
                        $folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';

                        $dirs = getDirs($folderName);

                        foreach ($dirs as $dir) {
                    ?>
                        <div class="row m-0 p-3 text-center">
                            <div class="col col-6 d-flex align-items-center">
                                <img class="mr-3" height="20" width="20" src="<?= $baseUrl; ?>/php-filesystem-explorer/node_modules/@icon/simple-line-icons/icons/<?= $dir['icon']; ?>" />
                                <button type="button" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" onclick="window.location.href='./dashboard.php?dir=<?= $dir['name']; ?>'"><?= $dir['name']; ?></button>
                            </div>
                            <div class="col col-3 d-flex align-items-center"><?= $dir['last-modified']; ?></div>
                            <div class="col col-3 d-flex align-items-center"><?= $dir['file-size']; ?></div>
                        </div>
                    <?php } ?>

                    <?php
                        $folderName = isset($_GET['dir']) ? $_GET['dir'] : 'files';

                        $files = getFiles($folderName);

                        foreach ($files as $file) {
                    ?>
                        <div class="row m-0 p-3 text-center">
                            <div class="col col-6 d-flex align-items-center">
                                <img class="mr-3" height="20" width="20" src="http://localhost/php-filesystem-explorer/node_modules/@icon/simple-line-icons/icons/<?= $file['icon']; ?>" />
                                <button type="button" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" onclick="window.location.href='<?= $file['url']; ?>'"><?= $file['name']; ?></button>
                            </div>
                            <div class="col col-3 d-flex align-items-center"><?= $file['last-modified']; ?></div>
                            <div class="col col-3 d-flex align-items-center"><?= $file['file-size']; ?></div>
                        </div>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave,<b>
                                <?php echo $_SESSION['name']; ?></b>
                            ?</h5>
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

</body>

</html>