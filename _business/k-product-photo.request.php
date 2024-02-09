<?php
session_start();
require_once __DIR__.'/../_classes/k-product.class.php';
require_once __DIR__.'/../_classes/k-product-photo.class.php';
require_once 'fonksiyon.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$productPhotosModel = new KProductPhoto();
$productModel=new KProduct();



    if (isset($_POST['add_k_product_photos'])) {

        

        $productId = $_POST['k_product_id'];
        $product=$productModel->getProductById($productId);

        

        $files = $_FILES['k_product_photo'];
        $uploadDirectory = "../../assets/img/products/";         
  
        $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif');

        

        foreach ($files['name'] as $key => $file_name) {
            $file_tmp = $files['tmp_name'][$key];
        // $file_type = $files['type'][$key];
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $uploadedFile = $files['tmp_name'][ $key];
            $fileExtension = pathinfo($files['name'][ $key], PATHINFO_EXTENSION);

            if (!in_array($fileExtension, $allowedExtensions)) {
                header("Location:../pages/k-product-photo?error=invalid_extension");
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
                header("Location:../pages/k-product-photos?error=true"); exit();
            }
            $photosData=array(
                "photo_name"=> $newFileName.".".$fileExtension,
                "k_product_id"=> $productId,
            );

            $result = $productPhotosModel->addProductPhoto($photosData);

            if ($key==0&&$product['main_photo_id']==null) {
                $photos=$productPhotosModel->getPhotosByProductId($product['k_product_id']);
                $result=$productModel->updateProductMainPhoto($product['k_product_id'],$photos[$key]['k_photo_id']);
            }

            if (!$result) { header("Location:../pages/k-product-photos?error=true"); exit(); }

        }

        header("Location:../pages/k-product-photos?success=true&k_product_id=".$productId."&main_photo=".$product['main_photo_id']);
    }

    if(isset($_GET['main_photo_id'])&&isset($_GET['k_product_id']))
    {
        $productId=$_GET['k_product_id'];
        $mainPhotoId=$_GET['main_photo_id'];

        $result=$productModel->updateProductMainPhoto($productId,$mainPhotoId);



        if ($result) {
            $product=$productModel->getProductById($productId);
            header("Location:../pages/k-product-photos?success=true&k_product_id=".$product['k_product_id']."&main_photo=".$product['main_photo_id']);
            exit();
        }
        else {
            header("Location:../pages/k-product-photos?success=true&k_product_id=".$productId."&main_photo=".$mainPhotoId);
            exit();
        }

    }

    if(isset($_GET['k_photo_id'])&&$_GET['delete']==true)
    {
        $photoId=$_GET['k_photo_id'];
        $productId=$_GET['k_product_id'];

        $product=$productModel->getProductById($productId);
        $oldPhotoPath=$productPhotosModel->getProductPhotoById($photoId);
        $result=false;

        if($photoId==$product['main_photo_id']){
            $photos=$productPhotosModel->getPhotosByProductId($product['k_product_id']);

            if (count($photos) > 1) {
                // Rastgele bir fotoğraf seçme
                $randomPhotoIndex = array_rand($photos);
                $randomPhotoId = $photos[$randomPhotoIndex]['k_photo_id'];

                while ($randomPhotoId == $photoId) {
                    $randomPhotoIndex = array_rand($photos);
                    $randomPhoto = $photos[$randomPhotoIndex];
                    $randomPhotoId = $randomPhoto['k_photo_id'];
                }
    
                // Seçilen rastgele fotoğrafı ana fotoğraf yapma
                $result_update_main_photo = $productModel->updateProductMainPhoto($product['k_product_id'], $randomPhotoId);

                
            }
            else if(count($photos) == 1){
                $result_update_main_photo = $productModel->updateProductMainPhoto($product['k_product_id'], null);
               
            }

            if($result_update_main_photo) {
                $result=$productPhotosModel->deleteProductPhoto($photoId);
                
            }
            else{
                header("Location:../pages/k-product-photos?success=false&k_product_id=".$product['k_product_id']);
                exit();
            }

        }
        else {
            $result=$productPhotosModel->deleteProductPhoto($photoId);
        }


        if ($result) {

            
            unlink("../../assets/img/products/".$oldPhotoPath['photo_name']);
            header("Location:../pages/k-product-photos?success=true&k_product_id=".$product['k_product_id']);
            exit();
        }
        else {
            header("Location:../pages/k-product-photos?success=false&k_product_id=".$productId);
            exit();
        }

    }


?>