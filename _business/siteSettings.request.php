<?php
require_once '../_classes/siteSettings.class.php';
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


//--------------------- Site Email ---------------------
if (isset($_POST['site_logo'])) {
    $uploadDirectory = '../../assets/img/';
    $uploadedFile = $uploadDirectory. uniqid() . "-logo." .pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
    $uploadedExtension = pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    
    

    // Geçerli dosya uzantısı kontrolü
    if (!in_array($uploadedExtension, $allowedExtensions)) {
        // Geçersiz dosya uzantısı, hata mesajı göster veya yönlendirme yapabilirsiniz
        header("Location:../pages/settings.php?error=invalid_extension");
        exit();
    }

    // Dosyayı belirtilen dizine yükle
    if (move_uploaded_file($_FILES['site_logo']['tmp_name'], $uploadedFile)) {
        // Dosya yükleme başarılıysa boyut kontrolü ve düşürme
        $maxFileSize = 1 * 1024 * 1024; // 1 MB

       

        // Dosya boyutunu kontrol etme
        if (filesize($uploadedFile) > $maxFileSize) {
            // Dosya boyutu 1 MB'tan büyükse düşür
            
            $image = imagecreatefromstring(file_get_contents($uploadedFile));
            imagejpeg($image, $targetFile, 75); // 75: JPEG kalitesi (0 ile 100 arasında)
            imagedestroy($image);
        }

        // Eski dosyayı sil
        $oldLogoPath = $siteSettingsModel->getSiteLogo();
        unlink($oldLogoPath);
        // Veritabanında güncelleme işlemleri burada gerçekleştirilebilir
        $result = $siteSettingsModel->updateSiteLogo($uploadedFile);

        header("Location:../pages/settings.php?success=true");
        exit();
    } else {
        header("Location:../pages/settings.php?error=true");
        exit();
    }
}


?>