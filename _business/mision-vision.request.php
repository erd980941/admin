<?php
session_start();
require_once __DIR__.'/../_classes/mision-vision.class.php';
include 'fonksiyon.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$misionVisionModel = new MisionVision();

//--------------------- Site Ayarları ---------------------
if (isset($_POST['mision_vision_update'])) {

    $mv_type=$_POST['mv_type'];

    if (!empty($_FILES['mv_image']['name'])) {
        $uploadDirectory = "../../assets/img/";
        $fileExtension = pathinfo($_FILES['mv_image']['name'], PATHINFO_EXTENSION);
        $uploadedFile = $_FILES['mv_image']['tmp_name'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        $newFileName =  "misyon-vizyon" . "_" . date("Y-m-d_His").".".$fileExtension;


        if (!in_array($fileExtension, $allowedExtensions)) {
            header("Location:../pages/mision-vision?error=invalid_extension");
            exit();
        }

        $maxFileSize = 1 * 1024 * 1024; // 1 MB
        $fileSize = filesize($uploadedFile);

        if ($fileSize > $maxFileSize) {
            
            $image = imagecreatefromstring(file_get_contents($uploadedFile));
            imagejpeg($image, $uploadedFile, 75); // 75: JPEG kalitesi (0 ile 100 arasında)
            imagedestroy($image);
        }

        $targetFile = $uploadDirectory . $newFileName ;
        $isUploaded = move_uploaded_file($uploadedFile, $targetFile);
        

        if(!$isUploaded) { $resultImage=false;goto x; }

        $oldMisionVisionImage = $misionVisionModel->getMisionVisionImage($mv_type);
        unlink("../../assets/img/".$oldMisionVisionImage);
        $resultImage = $misionVisionModel->updateMisionVisionImage($newFileName,$mv_type);
    }
    else{
        $resultImage = true;
    }

    

    $misionVisionData = [
        'mv_title' => $_POST['mv_title'],
        'mv_content' => $_POST['mv_content'],
        'mv_type' => $_POST['mv_type'],
    ];

    $result = $misionVisionModel->updateMisionVision($misionVisionData);

    x:

    if ($result && $resultImage) {
        header("Location:../pages/mision-vision?success=true");
        exit();
    } else {
        header("Location:../pages/mision-vision?error=true");
        exit();
    }
}





?>