<?php
require_once __DIR__.'/../_classes/about-us.class.php';
$aboutUsModel = new AboutUs();

//-----------------Smtp Email Ayarları------------------
$aboutUs = $aboutUsModel->getAboutUs();


//-----------------LOGO------------------


?>