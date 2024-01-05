<?php 
    require_once __DIR__.'/../_classes/product-photo.class.php';

    $photoModel=new ProductPhoto();

    if(isset($_GET['product_id'])){
        $productId=$_GET['product_id'];

        $photosDataByProductId=$photoModel->getPhotosByProductId($productId);
    }
?>