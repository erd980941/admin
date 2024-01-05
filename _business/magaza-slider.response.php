<?php 
    require_once __DIR__.'/../_classes/magaza-slider.class.php';

    $magazaSliderModel= new MagazaSlider();

    $sliderItems=$magazaSliderModel->getSliderItems();

    if(isset($_GET['slider_id'])&&$_GET['edit']==true){

        $sliderId=$_GET['slider_id'];
        $sliderById=$magazaSliderModel->getSliderItemById($sliderId);

        $sliderData = array(
            'slider_id' => htmlspecialchars($sliderById['slider_id']),
            'slider_path' => htmlspecialchars($sliderById['slider_path']),
            'slider_title' => htmlspecialchars($sliderById['slider_title']),
            'slider_url' => htmlspecialchars($sliderById['slider_url']),
            'order_priority' => htmlspecialchars($sliderById['order_priority']),
        );
    
        $sliderImage=$sliderData['slider_path'];
        if (empty($sliderImage)) {
            $sliderImage = 'no-image.jpg';
        } else {
            $sliderImage = htmlspecialchars($sliderImage);
        }
    }
?>