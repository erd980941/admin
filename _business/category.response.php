<?php 
require_once __DIR__.'/../_classes/category.class.php';
$categoryModel = new Category();

$categories = $categoryModel->getCategories();

if (isset($_GET['category_id'])&&$_GET['edit']==true) {

    $categoryId = $_GET['category_id'];
    $categoryById = $categoryModel->getCategoryById($categoryId);

    $categoryData = array(
        'category_id' => htmlspecialchars($categoryById['category_id']),
        'category_title' => htmlspecialchars($categoryById['category_title']),
        'parent_id' => htmlspecialchars($categoryById['parent_id']),
    );


}
?>