<?php
session_start();
require_once __DIR__.'/../_classes/category.class.php';
require_once 'fonksiyon.php';
$categoryModel = new Category();


if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

//--------------------- Site Ayarları ---------------------
if (isset($_POST['add_category'])) {


    $categoryData=array(
        'category_title' => $_POST['category_title'],
        'parent_id'=> ($_POST['parent_id'] !== '') ? $_POST['parent_id'] :null,
    );
    
    

    $result = $categoryModel->createCategory($categoryData);

    if ($result) {
        header("Location:../pages/category-list?success=true");
        exit();
    } else {
        header("Location:../pages/category-list?error=true");
        exit();
    }
}

if (isset($_POST['edit_category'])) {


    $categoryData=array(
        'category_id' => $_POST['category_id'],
        'category_title' => $_POST['category_title'],
        'parent_id'=>($_POST['parent_id'] !== '') ? $_POST['parent_id'] :null,
    );

    $result = $categoryModel->updateCategory($categoryData);

    if ($result) {
        header("Location:../pages/category-list?success=true");
        exit();
    } else {
        header("Location:../pages/category-list?error=true");
        exit();
    }
}

if (isset($_GET['category_id'])&&$_GET['delete']=='true') {

    $categoryId = $_GET['category_id'];

    
    $result = $categoryModel->deleteCategoryRecursive($categoryId);

    if ($result) {
        header("Location:../pages/category-list?success=true");
        exit();
    } else {
        header("Location:../pages/category-list?error=true");
        exit();
    }
}


?>
