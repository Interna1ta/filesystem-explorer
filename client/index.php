<?php
session_start();

require_once("./modules/filemanage.php");
require_once("./modules/directorymanage.php");

$rootUrl = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];

$folderName = "files";
$newFileName = "firstFile5";
$fileContent = "some text here";
$fileExtension = "txt";

$newDirectoryName = 'blabla';

// createDirectory($folderName, $newDirectoryName);

// createFile($folderName, $newFileName, $fileContent, $fileExtension);
// openFile($folderName, $newFileName, $fileExtension);
// uploadFile($folderName);
// deleteFile($folderName, $newFileName, $fileExtension);

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['email']);
  header("Refresh:2; location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>My first dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">

                    <?php
                    if (!isset($_SESSION['email']) && !isset($_SESSION['errorMessage']) && !isset($_GET['logout'])) {
                      echo '<h1 class="h4 text-gray-900 mb-4">';
                      echo 'Ruff! Password or bite, you choose!';
                      echo '</h1>';
                    } elseif (isset($_SESSION['errorMessage'])) {
                      echo '<h1 class="h4 text-gray-900 mb-4">';
                      echo $_SESSION['errorMessage'];
                      echo '</h1>';
                    } elseif ($_GET['logout']) {
                      echo '<h1 class="h4 text-gray-900 mb-4">';
                      echo 'We hope to see you back soon!';
                      echo '</h1>';
                    } else {
                      header('Location: ./dashboard.php');
                    }
                    ?>
                  </div>
                  <form class="user" action='./modules/login.php' method='POST'>
                    <div class="form-group">
                      <input name="name" type="name" class="form-control form-control-user" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter Your Name..." required />
                    </div>
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required />
                    </div>
                    <div class="form-group">
                      <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required />
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" />
                  </form>

                </div>
              </div>
            </div>
          </div>
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
  <script src="js/changeName.js"></script>
</body>

</html>