<?php
session_start();
require_once __DIR__.'/../_classes/product.class.php';
require_once __DIR__.'/../_classes/product-photo.class.php';
require_once 'fonksiyon.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$productPhotosModel = new ProductPhoto();
$productModel=new Product();



    if (isset($_POST['add_product_photos'])) {

        $productId = $_POST['product_id'];
        $product=$productModel->getProductById($productId);

        $files = $_FILES['product_photo'];
        $uploadDirectory = "../../assets/img/products/";         
  
        $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif');

        

        foreach ($files['name'] as $key => $file_name) {
            $file_tmp = $files['tmp_name'][$key];
        // $file_type = $files['type'][$key];
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $uploadedFile = $files['tmp_name'][ $key];
            $fileExtension = pathinfo($files['name'][ $key], PATHINFO_EXTENSION);

            if (!in_array($fileExtension, $allowedExtensions)) {
                header("Location:../pages/our-brands?error=invalid_extension");
                exit();
            }
            $newFileName = seo($product['product_name']) . "_" . date("YmdHis"). "_". mt_rand(1000, 9999);

            // $maxFileSize = 1 * 1024 * 1024; // 1 MB
            // $fileSize = filesize($uploadedFile);

            // if ($fileSize > $maxFileSize) {
            //     $image = imagecreatefromstring(file_get_contents($uploadedFile));
            //     imagejpeg($image, $uploadedFile, 75); // 75: JPEG kalitesi (0 ile 100 arasında)
            //     imagedestroy($image);
            // }
            $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
            $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

            if (!$isUploaded) {
                header("Location:../pages/product-photos?error=true"); exit();
            }
            $photosData=array(
                "photo_name"=> $newFileName.".".$fileExtension,
                "product_id"=> $productId,
            );

            $result = $productPhotosModel->addProductPhoto($photosData);

            if ($key==0&&$product['main_photo_id']==null) {
                $photos=$productPhotosModel->getPhotosByProductId($product['product_id']);
                $result=$productModel->updateProductMainPhoto($product['product_id'],$photos[$key]['photo_id']);
            }

            if (!$result) { header("Location:../pages/product-photos?error=true"); exit(); }

        }

        header("Location:../pages/product-photos?success=true&product_id=".$productId."&main_photo=".$product['main_photo_id']);
    }

    if(isset($_GET['main_photo_id'])&&isset($_GET['product_id']))
    {
        $productId=$_GET['product_id'];
        $mainPhotoId=$_GET['main_photo_id'];

        $result=$productModel->updateProductMainPhoto($productId,$mainPhotoId);



        if ($result) {
            $product=$productModel->getProductById($productId);
            header("Location:../pages/product-photos?success=true&product_id=".$product['product_id']."&main_photo=".$product['main_photo_id']);
            exit();
        }
        else {
            header("Location:../pages/product-photos?success=true&product_id=".$productId."&main_photo=".$mainPhotoId);
            exit();
        }

    }

    if(isset($_GET['photo_id'])&&$_GET['delete']==true)
    {
        $photoId=$_GET['photo_id'];
        $productId=$_GET['product_id'];

        $product=$productModel->getProductById($productId);
        $oldPhotoPath=$productPhotosModel->getProductPhotoById($photoId);
        $result=false;

        if($photoId==$product['main_photo_id']){
            $photos=$productPhotosModel->getPhotosByProductId($product['product_id']);

            if (count($photos) > 1) {
                // Rastgele bir fotoğraf seçme
                $randomPhotoIndex = array_rand($photos);
                $randomPhotoId = $photos[$randomPhotoIndex]['photo_id'];

                while ($randomPhotoId == $photoId) {
                    $randomPhotoIndex = array_rand($photos);
                    $randomPhoto = $photos[$randomPhotoIndex];
                    $randomPhotoId = $randomPhoto['photo_id'];
                }
    
                // Seçilen rastgele fotoğrafı ana fotoğraf yapma
                $result_update_main_photo = $productModel->updateProductMainPhoto($product['product_id'], $randomPhotoId);

                
            }
            else if(count($photos) == 1){
                $result_update_main_photo = $productModel->updateProductMainPhoto($product['product_id'], null);
               
            }

            if($result_update_main_photo) {
                $result=$productPhotosModel->deleteProductPhoto($photoId);
                
            }
            else{
                header("Location:../pages/product-photos?success=false&product_id=".$product['product_id']);
                exit();
            }

        }
        else {
            $result=$productPhotosModel->deleteProductPhoto($photoId);
        }


        if ($result) {

            
            unlink("../../assets/img/products/".$oldPhotoPath['photo_name']);
            header("Location:../pages/product-photos?success=true&product_id=".$product['product_id']);
            exit();
        }
        else {
            header("Location:../pages/product-photos?success=false&product_id=".$productId);
            exit();
        }

    }


?>