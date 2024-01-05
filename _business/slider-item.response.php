<?php 
    require_once __DIR__.'/../_classes/slider-item.class.php';

    $sliderItemModel= new SliderItem();

    $sliderItems=$sliderItemModel->getSliderItems();

    if(isset($_GET['slider_id'])&&$_GET['edit']==true){

        $sliderId=$_GET['slider_id'];
        $sliderById=$sliderItemModel->getSliderItemById($sliderId);

        $sliderData = array(
            'slider_id' => htmlspecialchars($sliderById['slider_id']),
            'slider_path' => htmlspecialchars($sliderById['slider_path']),
            'slider_title' => htmlspecialchars($sliderById['slider_title']),
            'slider_type' => htmlspecialchars($sliderById['slider_type']),
            'order_priority' => htmlspecialchars($sliderById['order_priority']),
        );
    
        $sliderPath=$sliderData['slider_path'];
        if (empty($sliderImage)) {
            $siteLogoPath = '../../assets/img/no-image.jpg';
        } else {
            $siteLogoPath = htmlspecialchars($siteLogoPath);
        }
    }
?>