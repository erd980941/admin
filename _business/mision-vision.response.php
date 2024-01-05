<?php
require_once __DIR__.'/../_classes/mision-vision.class.php';
$misionVisionModel = new MisionVision();
$mision = $misionVisionModel->getMisionVision('mision');
if(empty($mision)){
    echo "hello";
}
$mision = array(
    'mv_image' => htmlspecialchars($mision['mv_image']),
    'mv_title' => htmlspecialchars($mision['mv_title']),
    'mv_content' => htmlspecialchars($mision['mv_content']),
    'mv_type' => htmlspecialchars($mision['mv_type']),
);

$misionImage = $mision['mv_image'];
if (empty($misionImage)) {
    $misionImage = 'no-image.jpg';
} else {
    $misionImage = htmlspecialchars($misionImage);
}



$vision = $misionVisionModel->getMisionVision('vision');

$vision = array(
'mv_image' => htmlspecialchars($vision['mv_image']),
'mv_title' => htmlspecialchars($vision['mv_title']),
'mv_content' => htmlspecialchars($vision['mv_content']),
'mv_type' => htmlspecialchars($vision['mv_type']),
);


$visionImage = $vision['mv_image'];
if (empty($visionImage)) {
    $visionImage = 'no-image.jpg';
} else {
    $visionImage = htmlspecialchars($visionImage);
}

?>