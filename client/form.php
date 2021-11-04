<?php
    session_start();

    $path = $_POST['path'];
    $_SESSION['path'] = $path;
    header('Location: ./');
