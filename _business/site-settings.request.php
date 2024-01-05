<?php
session_start();
require_once __DIR__.'/../_classes/site-settings.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$siteSettingsModel = new SiteSettings();

//--------------------- Site Ayarları ---------------------
if (isset($_POST['site_settings'])) {
    $siteSettingsData = [
        'site_title' => $_POST['site_title'],
        'site_description' => $_POST['site_description'],
        'site_keywords' => $_POST['site_keywords'],
        'site_author' => $_POST['site_author'],
        'site_zopim' => $_POST['site_zopim'],
        'site_maps' => $_POST['site_maps'],
        'site_url' => $_POST['site_url'],
    ];

    $result = $siteSettingsModel->updateSiteSettings($siteSettingsData);

    if ($result) {
        header("Location:../pages/settings?success=true");
        exit();
    } else {
        header("Location:../pages/settings?error=true");
        exit();
    }
}




//--------------------- Site İletişim Ayarları ---------------------
if (isset($_POST['site_contact_information'])) {
    $contactInformationData = [
        'site_city' => $_POST['site_city'],
        'site_district' => $_POST['site_district'],
        'site_address' => $_POST['site_address'],
        'site_tel' => $_POST['site_tel'],
    ];



    $result = $siteSettingsModel->updateContactInformation($contactInformationData);

    if ($result) {
        header("Location:../pages/settings?success=true");
        exit();
    } else {
        header("Location:../pages/settings?error=true");
        exit();
    }
}



//--------------------- Site Email ---------------------
if (isset($_POST['site_email'])) {
    $siteEmailData = [
        'site_smtpEmail' => $_POST['site_smtpEmail'],
        'site_smtpHost' => $_POST['site_smtpHost'],
        'site_smtpPort' => $_POST['site_smtpPort'],
        'site_smtpUser' => $_POST['site_smtpUser'],
        'site_smtpPassword' => $_POST['site_smtpPassword'],
    ];

    $result = $siteSettingsModel->updateSiteEmail($siteEmailData);

    if ($result) {
        header("Location:../pages/settings?success=true");
        exit();
    } else {
        header("Location:../pages/settings?error=true");
        exit();
    }
}


//--------------------- Site LOGO ---------------------
if (isset($_POST['site_logo'])) {
    $uploadDirectory = '../../assets/img/';
    $fileExtension = pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['site_logo']['tmp_name'];
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    $newFileName = uniqid() . "-logo";



    if (!in_array($fileExtension, $allowedExtensions)) {
        header("Location:../pages/settings?error=invalid_extension");
        exit();
    }

    $maxFileSize = 1 * 1024 * 1024; // 1 MB
    $fileSize = filesize($uploadedFile);

    if ($fileSize > $maxFileSize) {

        $image = imagecreatefromstring(file_get_contents($uploadedFile));
        imagejpeg($image, $uploadedFile, 75); // 75: JPEG kalitesi (0 ile 100 arasında)
        imagedestroy($image);
    }

    $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
    $isUploaded= move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) { $result=false; goto x; }

    $oldLogoPath = $siteSettingsModel->getSiteLogo();
    unlink("../../assets/img/".$oldLogoPath);
    $result = $siteSettingsModel->updateSiteLogo($newFileName . '.' . $fileExtension);

    x:
    if ($result) {
        header("Location:../pages/settings?success=true");
        exit();
    }
    else{
        header("Location:../pages/settings?error=true");
        exit();
    }


}


?>