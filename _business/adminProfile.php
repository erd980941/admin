<?php
session_start();
include_once '../_classes/adminProfile.class.php';
$adminProfileModel = new AdminProfile();




if (isset($_POST['admin_changePassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $verifyPassword = $_POST['verifyPassword'];

    if ($newPassword != $verifyPassword) { header("Location:../pages/profile?error=true"); exit(); }

    $result = $adminProfileModel->changeAdminPassword($currentPassword, $newPassword);
    

    if ($result) {
        header("Location:../pages/profile?success=true");
        exit();
    } else {
        header("Location:../pages/profile?error=true");
        exit();
    }
}

if (isset($_POST['admin_changeUsername'])) {
    $adminUsername = $_POST['admin_username'];



    $result = $adminProfileModel->changeAdminUsername($adminUsername);
    

    if ($result) {
        header("Location:../pages/profile?success=true");
        exit();
    } else {
        header("Location:../pages/profile?error=true");
        exit();
    }
}



?>