<?php 
    require_once __DIR__.'/../_classes/why-us.class.php';
    $whyUsModel=new WhyUs();
    
    $whyUsItems=$whyUsModel->getWhyUsItems();

    if(isset($_GET['why_us_id'])){
        $whyUsId=$_GET['why_us_id'];
        $whyUsItem=$whyUsModel->getWhyUsItemById($whyUsId);
    }

    
?>