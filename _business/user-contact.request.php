<?php 
session_start();
    require_once __DIR__.'/../_classes/user-contact.class.php';

    if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
        header('Location: ../pages/login');
        exit;
    }

    $userContactModel=new UserContact();

    if (isset($_GET['contact_id'])&&$_GET['delete']==true) {

        $result = $userContactModel->deleteContact($_GET['contact_id']);
        if ($result) {
            header("Location:../pages/user-contact?success=true");
            exit();
        }
        else{
            header("Location:../pages/user-contact?error=true");
            exit();
        }
    }

?>