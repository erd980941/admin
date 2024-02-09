<?php
session_start();
require_once __DIR__.'/../_classes/k-category.class.php';
require_once 'fonksiyon.php';
$categoryModel = new KCategory();


if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

//--------------------- Site Ayarları ---------------------
if (isset($_POST['add_k_category'])) {

    

    $categoryData=array(
        'category_name' => $_POST['category_name'],
        'category_url' => seo($_POST['category_name']),
        'category_type' => $_POST['category_type'],
    );

    $category=$categoryModel->getCategoryByUrl($categoryData['category_url']);
    if(!empty($category)){
        header("Location:../pages/k-category-list?error=true");
        exit();
    }
    

    $result = $categoryModel->createCategory($categoryData);

    if ($result) {
        header("Location:../pages/k-category-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-category-list?error=true");
        exit();
    }
}

if (isset($_POST['edit_k_category'])) {


    $categoryData=array(
        'k_category_id' => $_POST['k_category_id'],
        'category_name' => $_POST['category_name'],
        'category_url' => seo($_POST['category_name']),
        'category_type' => $_POST['category_type'],
    );

    $category=$categoryModel->getCategoryByUrl($categoryData['category_url']);
    if(!empty($category)){
        header("Location:../pages/k-category-list?error=true");
        exit();
    }

    $result = $categoryModel->updateCategory($categoryData);

    if ($result) {
        header("Location:../pages/k-category-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-category-list?error=true");
        exit();
    }
}
if (isset($_GET['k_category_id'])&&$_GET['delete']=='true') {

    $categoryId = $_GET['k_category_id'];
    
    $result = $categoryModel->deleteCategory($categoryId);

    if ($result) {
        header("Location:../pages/k-category-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-category-list?error=true");
        exit();
    }
}




?>
