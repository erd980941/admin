<?php
session_start();
require_once __DIR__.'/../_classes/slider-item.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$sliderItemModel = new SliderItem();

if (isset($_POST['add_slider_item'])) {
    $uploadDirectory = "../../assets/img/slider/";
    $fileExtension = pathinfo($_FILES['slider_path']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['slider_path']['tmp_name'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'mp4'];

    $newFileName = "slider" . "_" . date("YmdHis");

    if (!in_array($fileExtension, $allowedExtensions)) {
        header("Location:../pages/slider-item-list?error=invalid_extension");
        exit();
    }

    $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
    $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) {
        $result = false;
        goto x;
    }

    $maxOrderPriority = $sliderItemModel->getMaxOrderPriority();
    $newOrderPriority = $maxOrderPriority + 1;
    $sliderData = [
        'slider_path' => $newFileName . '.' . $fileExtension,
        'slider_title' => $_POST['slider_title'],
        'slider_type' => $fileExtension == 'mp4' ? 'video' : 'image',
        'order_priority' => $newOrderPriority,
    ];

    $result = $sliderItemModel->addSliderItem($sliderData);

    x:

    if ($result) {
        header("Location:../pages/slider-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/slider-item-list?error=true");
        exit();
    }
}

if (isset($_POST['edit_slider_item'])) {
    $sliderId = $_POST['slider_id'];

    if (!empty($_FILES['slider_path']['name'])) {
        $uploadDirectory = "../../assets/img/slider/";
        $fileExtension = pathinfo($_FILES['slider_path']['name'], PATHINFO_EXTENSION);
        $uploadedFile = $_FILES['slider_path']['tmp_name'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'mp4'];

        $newFileName = "slider" . "_" . date("YmdHis");

        if (!in_array($fileExtension, $allowedExtensions)) {
            header("Location:../pages/slider-item-list?error=invalid_extension");
            exit();
        }


        $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
        $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

        if (!$isUploaded) {
            $result = false;
            goto a;
        }


        $oldSliderPath = $sliderItemModel->getSliderPathById($sliderId);
        unlink($uploadDirectory . $oldSliderPath);
        $sliderPath = $newFileName . '.' . $fileExtension;
        $sliderPathData = [
            'slider_path' => $sliderPath,
            'slider_type' => $fileExtension == 'mp4' ? 'video' : 'image'
        ];
        $resultImage = $sliderItemModel->updateSliderPath($sliderPathData, $sliderId);
    } else {
        $resultImage = true;
    }

    $existingPriority = $sliderItemModel->checkOrderPriorityExists($_POST['order_priority']);
    if($existingPriority){
        $getSliderItem=$sliderItemModel->getSliderItemById($sliderId);
        $orderPriority=$getSliderItem['order_priority'];
    }else{
        $orderPriority=$_POST['order_priority'];
    }
    $sliderData = [

        'slider_id' => $_POST['slider_id'],
        'slider_title' => $_POST['slider_title'],
        'order_priority' => $orderPriority,
    ];

    $result = $sliderItemModel->updateSliderItem($sliderData);

    a:

    if ($result && $resultImage) {
        header("Location:../pages/slider-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/slider-item-list?error=true");
        exit();
    }
}

if (isset($_GET['slider_id']) && $_GET['delete'] == 'true') {

    $sliderId = $_GET['slider_id'];



    $oldSliderPath = $sliderItemModel->getSliderPathById($sliderId);
    unlink("../../assets/img/slider/" . $oldSliderPath);

    $result = $sliderItemModel->deleteSliderItem($sliderId);

    if ($result) {
        header("Location:../pages/slider-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/slider-item-list?error=true");
        exit();
    }
}


if (isset($_GET["slider_id"]) && $_GET["increase"] == true) {
    $sliderId = $_GET["slider_id"];

    $orderPriority = $sliderItemModel->getSliderOrderPriority($sliderId);
    $existingPriority = $sliderItemModel->checkOrderPriorityExists($orderPriority + 1);
    if ($orderPriority === null || $orderPriority === -1) {
        header("Location: ../pages/slider-item-list?error=true");
        exit();
    } else if($existingPriority){
        header("Location: ../pages/slider-item-list?error=true");
        exit();
    }

    $orderPriority++;
    $result = $sliderItemModel->updateSliderOrderPriority($orderPriority, $sliderId);

    if ($result) {
        header("Location:../pages/slider-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/slider-item-list?error=true");
        exit();
    }
}
if (isset($_GET["slider_id"]) && $_GET["decrease"] == true) {
    $sliderId = $_GET["slider_id"];

    $orderPriority = $sliderItemModel->getSliderOrderPriority($sliderId);
    $existingPriority = $sliderItemModel->checkOrderPriorityExists($orderPriority - 1);
    if ($orderPriority === null || $orderPriority === -1) {
        header("Location: ../pages/slider-item-list?error=true");
        exit();
    } else if($existingPriority){
        header("Location: ../pages/slider-item-list?error=true");
        exit();
    }

    $orderPriority--;
    $result = $sliderItemModel->updateSliderOrderPriority($orderPriority, $sliderId);

    if ($result) {
        header("Location:../pages/slider-item-list?success=true");
        exit();
    } else {
        header("Location:../pages/slider-item-list?error=true");
        exit();
    }
}

?>