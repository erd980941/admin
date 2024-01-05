<?php 
    require_once __DIR__.'/../_classes/product.class.php';
    $productModel=new Product();
    
    $products=$productModel->getProducts();

    if(isset($_GET['product_id'])){
        $productId=$_GET['product_id'];
        $product=$productModel->getProductById($productId);
    }

    
?>