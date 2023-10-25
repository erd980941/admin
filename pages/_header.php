<?php 
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit;
}
?>
<?php include_once 'views/header.php' ?>
<!-- Page Wrapper -->
<div id="wrapper">

    <?php include_once 'views/sidebar.php' ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include_once 'views/topbar.php' ?>
            <div class="container-fluid">
                <?php include_once 'views/alert.php' ?>
    