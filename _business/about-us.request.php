<?php
require_once '../_classes/about-us.class.php';
include 'fonksiyon.php';
$aboutUsModel = new AboutUs();

//--------------------- Site Ayarları ---------------------
if (isset($_POST['about_us_update'])) {


    if (!empty($_FILES['about_image']['name'])) {
        $uploadDirectory = "../../assets/img/";
        $fileExtension = pathinfo($_FILES['about_image']['name'], PATHINFO_EXTENSION);
        $uploadedFile = $_FILES['about_image']['tmp_name'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        $newFileName = seo($_POST['about_image_alt']) . "_" . date("Y-m-d_His");


        if (!in_array($fileExtension, $allowedExtensions)) {
            header("Location:../pages/about-us?error=invalid_extension");
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
        move_uploaded_file($uploadedFile, $targetFile);

        $oldLogoPath = $aboutUsModel->getAboutUsImage();
        unlink($oldLogoPath);
        $resultImage = $aboutUsModel->updateAboutUsImage($targetFile);
    }
    else{
        $resultImage = true;
    }

    $aboutUsData = [
        'about_title' => $_POST['about_title'],
        'about_content' => $_POST['about_content'],
        'about_image_alt' => $_POST['about_image_alt'],
    ];

    $result = $aboutUsModel->updateAboutUs($aboutUsData);

    if ($result && $resultImage) {
        header("Location:../pages/about-us?success=true");
        exit();
    } else {
        header("Location:../pages/about-us?error=true");
        exit();
    }
}





?>