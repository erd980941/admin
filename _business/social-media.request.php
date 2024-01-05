<?php
session_start();
require_once __DIR__.'/../_classes/social-media.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$socialMediaModel = new SocialMedia();

//--------------------- Site Ayarları ---------------------
if (isset($_POST['update_social_media'])) {
    $socialMediaData = [
        'whatsapp' => htmlspecialchars($_POST['whatsapp']),
        'instagram' => htmlspecialchars($_POST['instagram']),
        'facebook' => htmlspecialchars($_POST['facebook']),
        'hepsiburada' => htmlspecialchars($_POST['hepsiburada']),
        'n11' => htmlspecialchars($_POST['n11']),
        'sahibinden' => htmlspecialchars($_POST['sahibinden']),
    ];

    $result = $socialMediaModel->updateSocialMedia($socialMediaData);

    if ($result) {
        header("Location:../pages/social-media?success=true");
        exit();
    } else {
        header("Location:../pages/social-media?error=true");
        exit();
    }
}








?>