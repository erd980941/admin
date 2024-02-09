<?php 
    require_once __DIR__.'/../_classes/k-product.class.php';
    $productModel=new KProduct();
    
    $products=$productModel->getProducts();

    if(isset($_GET['k_product_id'])){
        $productId=$_GET['k_product_id'];
        $product=$productModel->getProductById($productId);
    }
    else if(isset($_GET['k_product_id'])&&$_GET['edit']==true){
        $productId=$_GET['k_product_id'];
        $product=$productModel->getProductById($productId);
    }
    else if(isset($_GET['k_product_id'])&&$_GET['edit_pdf']==true){
        $productId=$_GET['k_product_id'];
        $product=$productModel->getDetailPDFByProductId($productId);
    }
    

    
?>