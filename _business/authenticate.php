<?php
session_start();
include_once '../_classes/authenticate.class.php';
$checkAdminCredentialsModel = new Authenticate();


// Kullanıcı adı ve şifreyi formdan al
if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

   

    $isValidUser = $checkAdminCredentialsModel->checkAdminCredentials($username, $password);
    

    if ($isValidUser) {
        // Doğrulama başarılıysa oturumu başlat ve ana sayfaya yönlendir
        $_SESSION['loggedin'] = true;
        header('Location:../pages/index'); // Kullanıcıyı yönlendir
        exit;
    } else {
        header('Location: ../pages/login?login=false');
    }
}





?>