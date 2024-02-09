<?php 
require_once __DIR__.'/../_classes/k-category.class.php';
$categoryModel = new KCategory();

$categories = $categoryModel->getCategories();

if (isset($_GET['k_category_id'])&&$_GET['edit']==true) {

    $categoryId = $_GET['k_category_id'];
    $categoryData = $categoryModel->getCategoryById($categoryId);

    


}
?>