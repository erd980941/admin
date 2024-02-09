<?php
session_start();
require_once __DIR__ . '/../_classes/k-product.class.php';
require_once __DIR__ . '/fonksiyon.php';
require_once __DIR__.'/../_classes/k-product-photo.class.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$productModel = new KProduct();

if (isset($_POST['add_k_product'])) {
    $productData = array(
        'product_name' => $_POST['product_name'],
        'product_short_description' => $_POST['product_short_description'],
        'product_description' => $_POST['product_description'],
        'product_properties' => $_POST['product_properties'],
        'product_url' => seo($_POST['product_name']),
        'product_link' => $_POST['product_link'],
        'product_featured' => $_POST['product_featured'],
        'k_category_id' => $_POST['k_category_id'],
    );

    $result = $productModel->addProduct($productData);

    if ($result) {
        header("Location:../pages/k-product-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-product-list?error=true");
        exit();
    }
} else if (isset($_POST['edit_k_product'])) {

    $productData = array(
        'k_product_id' => $_POST['k_product_id'],
        'product_name' => $_POST['product_name'],
        'product_short_description' => $_POST['product_short_description'],
        'product_description' => $_POST['product_description'],
        'product_properties' => $_POST['product_properties'],
        'product_url' => seo($_POST['product_name']),
        'product_link' => $_POST['product_link'],
        'product_featured' => $_POST['product_featured'],
        'k_category_id' => $_POST['k_category_id'],
    );

    $result = $productModel->updateProduct($productData);

    if ($result) {
        header("Location:../pages/k-product-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-product-list?error=true");
        exit();
    }
} else if (isset($_POST['edit_k_product_pdf'])) {

    if (empty($_FILES['detail_pdf']['name'])) {
        header("Location:../pages/k-product-list?error=true");
        exit();
    }
    $uploadDirectory = "../../assets/documents/products/";
    $fileExtension = pathinfo($_FILES['detail_pdf']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['detail_pdf']['tmp_name'];
    $allowedExtensions = 'pdf';

    $newFileName = seo($_POST['product_name']) . "_" . date("YmdHis");


    if ($fileExtension != $allowedExtensions) {
        header("Location:../pages/k-product-list?error=invalid_extension");
        exit();
    }


    $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
    $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) {
        $result = false;
        goto x;
    }


    $productData = [
        'detail_pdf' => $newFileName . '.' . $fileExtension,
        'k_product_id' => $_POST['k_product_id'],
    ];

    $productPdf=$productModel->getDetailPDFByProductId($_POST['k_product_id']);

    $result = $productModel->updateDetailPDF($productData);

    x:

    if ($result) {
        if(!empty($productPdf['detail_pdf'])){
            unlink("../../assets/documents/products/" . $productPdf['detail_pdf']);
        }
        header("Location:../pages/k-product-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-product-list?error=true");
        exit();
    }

} else if (isset($_GET['k_product_id']) && $_GET['delete'] == 'true') {
    $productId = htmlspecialchars($_GET['k_product_id']);
    $productPhotoModel = new KProductPhoto();
    $photos = $productPhotoModel->getPhotosByProductId($productId);
    $result = $productModel->deleteProduct($productId);
    if ($result) {
        foreach ($photos as $photo) {
            unlink("../../assets/img/products/" . $photo['photo_name']);
        }
        header("Location:../pages/k-product-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-product-list?error=true");
        exit();
    }
}else if (isset($_POST['k_product_delete_pdf'])) {
    $productId = htmlspecialchars($_POST['k_product_id']);
    $result = $productModel->deleteProductPdf($productId);
    if ($result) {
        unlink("../../assets/documents/products/" . $_POST['old_detail_pdf']);
        header("Location:../pages/k-product-list?success=true");
        exit();
    } else {
        header("Location:../pages/k-product-list?error=true");
        exit();
    }
} 
else {
    header("Location:../pages/k-product-list");
    exit();
}


?>