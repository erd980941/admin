<?php
require_once __DIR__.'/../_classes/our-brands.class.php';
$ourBrandsModel = new OurBrands();

$ourBrands = $ourBrandsModel->getAllBrands();


if (isset($_GET['brand_id'])&&$_GET['edit']==true) {

    $brandId = $_GET['brand_id'];
    $brandById = $ourBrandsModel->getBrandById($brandId);

    $brandData = array(
        'brand_id' => htmlspecialchars($brandById['brand_id']),
        'brand_image' => htmlspecialchars($brandById['brand_image']),
        'brand_title' => htmlspecialchars($brandById['brand_title']),
    );

    $brandImage=$brandData['brand_image'];
    if (empty($brandImage)) {
        $siteLogoPath = '../../assets/img/no-image.jpg';
    } else {
        $siteLogoPath = htmlspecialchars($siteLogoPath);
    }

}

?>