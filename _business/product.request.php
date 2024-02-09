<?php 
session_start();
    require_once __DIR__.'/../_classes/product.class.php';
    require_once __DIR__.'/../_classes/product-photo.class.php';

    if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
        header('Location: ../pages/login');
        exit;
    }
    
    $productModel=new Product();
    
    if (isset($_POST['add_product'])) {
        $productData=array(
            'product_name'=> $_POST['product_name'],
            'original_price'=> $_POST['original_price'],
            'discount_rate'=> $_POST['discount_rate'],
            'discounted_price'=> $_POST['original_price'] - ($_POST['original_price'] * $_POST['discount_rate'] / 100),
            'product_quantity'=> $_POST['product_quantity'],
            'product_description'=> $_POST['product_description'],
            'product_detail'=> $_POST['product_detail'],
            'product_featured'=> $_POST['product_featured'],
            'product_promotion'=> $_POST['product_promotion'],
            'category_id'=> $_POST['category_id'],
        );


        $result=$productModel->addProduct($productData);
        
        if ($result) {
            header("Location:../pages/product-list?success=true");
            exit();
        } else {
            header("Location:../pages/product-list?error=true");
            exit();
        }
    }

    else if (isset($_POST['edit_product'])) {
        $productData=array(
            'product_id'=> $_POST['product_id'],
            'product_name'=> $_POST['product_name'],
            'original_price'=> $_POST['original_price'],
            'discount_rate'=> $_POST['discount_rate'],
            'discounted_price'=> $_POST['original_price'] - ($_POST['original_price'] * $_POST['discount_rate'] / 100),
            'product_quantity'=> $_POST['product_quantity'],
            'product_description'=> $_POST['product_description'],
            'product_detail'=> $_POST['product_detail'],
            'product_featured'=> $_POST['product_featured'],
            'product_promotion'=> $_POST['product_promotion'],
            'category_id'=> $_POST['category_id'],
        );

        $result=$productModel->updateProduct($productData);
        
        if ($result) {
            header("Location:../pages/product-list?success=true");
            exit();
        } else {
            header("Location:../pages/product-list?error=true");
            exit();
        }
    }
    else if(isset($_GET['product_id'])&&isset($_GET['update_status'])){
        $productData=[
            'product_id'=>$_GET['product_id'],
            'product_status'=>$_GET['update_status'],
        ];
        $result=$productModel->updateProductStatus($productData);
        if ($result) {
            header("Location:../pages/product-list?success=true");
            exit();
        } else {
            header("Location:../pages/product-list?error=true");
            exit();
        }
        
    }
    else if (isset($_GET['product_id'])&&$_GET['delete']=='true') {
        $productId=htmlspecialchars($_GET['product_id']);
        $productPhotoModel=new ProductPhoto();
        $photos=$productPhotoModel->getPhotosByProductId($productId);
        $result =$productModel->deleteProduct($productId);
        if ($result) {
            foreach ($photos as $photo) {
                unlink("../../magaza/assets/img/products/".$photo['photo_name']);
            }
            header("Location:../pages/product-list?success=true");
            exit();
        } else {
            header("Location:../pages/product-list?error=true");
            exit();
        }
    }
    

    
?>