<?php
session_start();
require_once __DIR__.'/../_classes/our-brands.class.php';
require_once 'fonksiyon.php';
$ourBrandsModel = new OurBrands();

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

//--------------------- Site Ayarları ---------------------
if (isset($_POST['add_our_brands'])) {


    $uploadDirectory = "../../assets/img/our-brands/";
    $fileExtension = pathinfo($_FILES['brand_image']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['brand_image']['tmp_name'];
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    $newFileName = seo($_POST['brand_title']) . "_" . date("YmdHis");


    if (!in_array($fileExtension, $allowedExtensions)) {
        header("Location:../pages/our-brands?error=invalid_extension");
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
    $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) {
        $result = false;
        goto x;
    }


    $brandData = [
        'brand_image' => $newFileName . '.' . $fileExtension,
        'brand_title' => $_POST['brand_title'],
    ];

    $result = $ourBrandsModel->addBrand($brandData);

    x:

    if ($result) {
        header("Location:../pages/our-brands-list?success=true");
        exit();
    } else {
        header("Location:../pages/our-brands-list?error=true");
        exit();
    }
}

if (isset($_POST['edit_our_brands'])) {

    $brandId = $_POST['brand_id'];


    if (!empty($_FILES['brand_image']['name'])) {
        $uploadDirectory = "../../assets/img/our-brands/";
        $fileExtension = pathinfo($_FILES['brand_image']['name'], PATHINFO_EXTENSION);
        $uploadedFile = $_FILES['brand_image']['tmp_name'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        $newFileName = seo($_POST['brand_title']) . "_" . date("YmdHis");


        if (!in_array($fileExtension, $allowedExtensions)) {
            header("Location:../pages/our-brands?error=invalid_extension");
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
        $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

        if (!$isUploaded) {
            $result = false;
            goto a;
        }

        $oldBrandImagePath = $ourBrandsModel->getBrandImagePathById($brandId);
        unlink($uploadDirectory . $oldBrandImagePath);
        $brandImage = $newFileName . '.' . $fileExtension;
        $resultImage = $ourBrandsModel->updateBrandImage($brandImage, $brandId);
    } else {
        $resultImage = true;
    }


    $brandData = [

        'brand_title' => $_POST['brand_title'],
    ];

    $result = $ourBrandsModel->updateBrand($brandData, $brandId);

    a:

    if ($result && $resultImage) {
        header("Location:../pages/our-brands-list?success=true");
        exit();
    } else {
        header("Location:../pages/our-brands-list?error=true");
        exit();
    }
}

if (isset($_GET['brand_id'])&&$_GET['delete']=='true') {

    $brandId = $_GET['brand_id'];


    
    $oldBrandImagePath = $ourBrandsModel->getBrandImagePathById($brandId);
    unlink("../../assets/img/our-brands/" . $oldBrandImagePath);
    
    $result = $ourBrandsModel->deleteBrand($brandId);

    if ($result) {
        header("Location:../pages/our-brands-list?success=true");
        exit();
    } else {
        header("Location:../pages/our-brands-list?error=true");
        exit();
    }
}
?>