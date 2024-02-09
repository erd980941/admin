<?php 
session_start();
require_once __DIR__.'/../_classes/why-us.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$whyUsModel = new WhyUs();

if (isset($_POST['add_why_us'])) {
    $whyUsData = array(
        'why_us_title' => $_POST['why_us_title'],
        'why_us_content' => $_POST['why_us_content']
    );

    $result = $whyUsModel->addWhyUsItem($whyUsData);

    if ($result) {
        header("Location:../pages/why-us-list?success=true");
        exit();
    } else {
        header("Location:../pages/why-us-list?error=true");
        exit();
    }
}

else if (isset($_POST['edit_why_us'])) {
    $whyUsData = array(
        'why_us_id' => $_POST['why_us_id'],
        'why_us_title' => $_POST['why_us_title'],
        'why_us_content' => $_POST['why_us_content']
    );

    $result = $whyUsModel->updateWhyUsItem($whyUsData);

    if ($result) {
        header("Location:../pages/why-us-list?success=true");
        exit();
    } else {
        header("Location:../pages/why-us-list?error=true");
        exit();
    }
}

else if (isset($_GET['why_us_id']) && $_GET['delete'] == 'true') {
    $whyUsId = htmlspecialchars($_GET['why_us_id']);

    $result = $whyUsModel->deleteWhyUsItem($whyUsId);

    if ($result) {
        header("Location:../pages/why-us-list?success=true");
        exit();
    } else {
        header("Location:../pages/why-us-list?error=true");
        exit();
    }
}
?>