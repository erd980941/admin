<?php
session_start();
require_once __DIR__.'/../_classes/magaza-slider.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$magazaSliderModel = new MagazaSlider();

if (isset($_POST['add_magaza_slider'])) {
    $uploadDirectory = "../../assets/img/slider/";
    $fileExtension = pathinfo($_FILES['slider_path']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['slider_path']['tmp_name'];
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    $newFileName = "slider" . "_" . date("YmdHis");

    if (!in_array($fileExtension, $allowedExtensions)) {
        header("Location:../pages/magaza-slider-list?error=invalid_extension");
        exit();
    }

    $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
    $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) {
        $result = false;
        goto x;
    }

    $maxOrderPriority = $magazaSliderModel->getMaxOrderPriority();
    $newOrderPriority = $maxOrderPriority + 1;
   
    $sliderData = [
        'slider_path' => $newFileName . '.' . $fileExtension,
        'slider_title' => $_POST['slider_title'],
        'slider_url' => $_POST['slider_url']==""?"#":$_POST['slider_url'],
        'order_priority' => $newOrderPriority
    ];

    $result = $magazaSliderModel->addSliderItem($sliderData);

    x:

    if ($result) {
        header("Location:../pages/magaza-slider-list?success=true");
        exit();
    } else {
        header("Location:../pages/magaza-slider-list?error=true");
        exit();
    }
}

if (isset($_POST['edit_magaza_slider'])) {
    $sliderId = $_POST['slider_id'];

    if (!empty($_FILES['slider_path']['name'])) {
        $uploadDirectory = "../../assets/img/slider/";
        $fileExtension = pathinfo($_FILES['slider_path']['name'], PATHINFO_EXTENSION);
        $uploadedFile = $_FILES['slider_path']['tmp_name'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        $newFileName = "slider" . "_" . date("YmdHis");

        if (!in_array($fileExtension, $allowedExtensions)) {
            header("Location:../pages/magaza-slider-list?error=invalid_extension");
            exit();
        }


        $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
        $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

        if (!$isUploaded) {
            $result = false;
            goto a;
        }


        $oldSliderPath = $magazaSliderModel->getSliderPathById($sliderId);
        unlink($uploadDirectory . $oldSliderPath);
        $sliderPath = $newFileName . '.' . $fileExtension;
        $sliderPathData = [
            'slider_path' => $sliderPath,
        ];
        $resultImage = $magazaSliderModel->updateSliderPath($sliderPathData, $sliderId);
    } else {
        $resultImage = true;
    }

    $existingPriority = $magazaSliderModel->checkOrderPriorityExists($_POST['order_priority']);
    if($existingPriority){
        $getSliderItem=$magazaSliderModel->getSliderItemById($sliderId);
        $orderPriority=$getSliderItem['order_priority'];
    }else{
        $orderPriority=$_POST['order_priority'];
    }
    $sliderData = [

        'slider_id' => $_POST['slider_id'],
        'slider_title' => $_POST['slider_title'],
        'slider_url' => $_POST['slider_url']==""?"#":$_POST['slider_url'],
        'order_priority' => $orderPriority,
    ];

    $result = $magazaSliderModel->updateSliderItem($sliderData);

    a:

    if ($result && $resultImage) {
        header("Location:../pages/magaza-slider-list?success=true");
        exit();
    } else {
        header("Location:../pages/magaza-slider-list?error=true");
        exit();
    }
}

if (isset($_GET['slider_id']) && $_GET['delete'] == 'true') {

    $sliderId = $_GET['slider_id'];



    $oldSliderPath = $magazaSliderModel->getSliderPathById($sliderId);
    unlink("../../assets/img/slider/" . $oldSliderPath);

    $result = $magazaSliderModel->deleteSliderItem($sliderId);

    if ($result) {
        header("Location:../pages/magaza-slider-list?success=true");
        exit();
    } else {
        header("Location:../pages/magaza-slider-list?error=true");
        exit();
    }
}


if (isset($_GET["slider_id"]) && $_GET["increase"] == true) {
    $sliderId = $_GET["slider_id"];

    $orderPriority = $magazaSliderModel->getSliderOrderPriority($sliderId);
    $existingPriority = $magazaSliderModel->checkOrderPriorityExists($orderPriority + 1);
    if ($orderPriority === null || $orderPriority === -1) {
        header("Location: ../pages/magaza-slider-list?error=true");
        exit();
    }else if($existingPriority){
        header("Location: ../pages/magaza-slider-list?error=true");
        exit();
    }

    $orderPriority++;
    $result = $magazaSliderModel->updateSliderOrderPriority($orderPriority, $sliderId);

    if ($result) {
        header("Location:../pages/magaza-slider-list?success=true");
        exit();
    } else {
        header("Location:../pages/magaza-slider-list?error=true");
        exit();
    }
}
if (isset($_GET["slider_id"]) && $_GET["decrease"] == true) {
    $sliderId = $_GET["slider_id"];

    $orderPriority = $magazaSliderModel->getSliderOrderPriority($sliderId);
    $existingPriority = $magazaSliderModel->checkOrderPriorityExists($orderPriority - 1);
    if ($orderPriority === null || $orderPriority === -1) {
        header("Location: ../pages/magaza-slider-list?error=true");
        exit();
    }else if($existingPriority){
        header("Location: ../pages/magaza-slider-list?error=true");
        exit();
    }

    $orderPriority--;
    $result = $magazaSliderModel->updateSliderOrderPriority($orderPriority, $sliderId);

    if ($result) {
        header("Location:../pages/magaza-slider-list?success=true");
        exit();
    } else {
        header("Location:../pages/magaza-slider-list?error=true");
        exit();
    }
}

?>