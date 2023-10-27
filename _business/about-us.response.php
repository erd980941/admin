<?php
require_once '../_classes/about-us.class.php';
$aboutUsModel = new AboutUs();

//-----------------Smtp Email Ayarları------------------
$aboutUs = $aboutUsModel->getAboutUs();
$aboutUsData = array(
    'about_title' => htmlspecialchars($aboutUs['about_title']),
    'about_content' => htmlspecialchars($aboutUs['about_content']),
    'about_image' => htmlspecialchars($aboutUs['about_image']),
    'about_image_alt' => htmlspecialchars($aboutUs['about_image_alt']),
);


//-----------------LOGO------------------
$aboutUsImage = $aboutUsData['about_image'];
if (empty($aboutUsImage)) {
    $aboutUsImage = '../../assets/img/no-image.jpg';
} else {
    $aboutUsImage = htmlspecialchars($aboutUsImage);
}

?>