<?php
session_start();
require_once __DIR__.'/../_classes/gallery-item.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$galleryItemModel = new GalleryItem();

if (isset($_POST['add_gallery_item'])) {
    $uploadDirectory = "../../assets/img/gallery/";
    $fileExtension = pathinfo($_FILES['image_path']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['image_path']['tmp_name'];
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    $newFileName = "gallery-item" . "_" . date("YmdHis");

    if (!in_array($fileExtension, $allowedExtensions)) {
        header("Location:../pages/gallery-item-list?error=invalid_extension");
        exit();
    }

    $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
    $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) {
        $result = false;
        goto x;
    }

    $sliderData = [
        'image_path' => $newFileName . '.' . $fileExtension,
    ];

    $result = $galleryItemModel->addGalleryItem($sliderData);

    x:

    if ($result) {
        header("Location:../pages/gallery-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/gallery-item-list?error=true");
        exit();
    }
}



if (isset($_GET['item_id']) && $_GET['delete'] == 'true') {

    $itemId = $_GET['item_id'];



    $oldSliderPath = $galleryItemModel->getGalleryPathById($itemId);
    unlink("../../assets/img/gallery/" . $oldSliderPath);

    $result = $galleryItemModel->deleteGalleryItem($itemId);

    if ($result) {
        header("Location:../pages/gallery-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/gallery-item-list?error=true");
        exit();
    }
}

?>