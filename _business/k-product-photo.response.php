<?php 
    require_once __DIR__.'/../_classes/k-product-photo.class.php';

    $photoModel=new KProductPhoto();

    if(isset($_GET['k_product_id'])){
        $productId=$_GET['k_product_id'];

        $photosDataByProductId=$photoModel->getPhotosByProductId($productId);
    }
?>