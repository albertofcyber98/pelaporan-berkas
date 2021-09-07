<?php
    require '../../function.php';
    session_start();
    $_SESSION['nip']= '';
    unset($_SESSION['nip']);
    session_unset();
    session_destroy();
    header('Location: ../../index.php');
?>