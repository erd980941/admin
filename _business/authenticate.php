<?php
session_start();
include_once __DIR__.'/../_classes/authenticate.class.php';
$checkAdminCredentialsModel = new Authenticate();


// Kullanıcı adı ve şifreyi formdan al
if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

   

    $isValidUser = $checkAdminCredentialsModel->checkAdminCredentials($username, $password);
    

    if ($isValidUser) {
        // Doğrulama başarılıysa oturumu başlat ve ana sayfaya yönlendir
        $_SESSION['username'] = $username;
        $_SESSION['adminLoggedIn'] = true;
        header('Location:../pages/index'); // Kullanıcıyı yönlendir
        exit;
    } else {
        header('Location: ../pages/login?login=false');
    }
}





?>