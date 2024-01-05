<?php
require_once __DIR__.'/../_classes/our-document.class.php';
$ourDocumentModel = new OurDocument();

$ourdocuments = $ourDocumentModel->getAllDocuments();

if (isset($_GET['document_id'])&&$_GET['edit']==true) {

    $documentId = $_GET['document_id'];
    $documentById = $ourDocumentModel->getDocumentById($documentId);

    $documentData = array(
        'document_id' => htmlspecialchars($documentById['document_id']),
        'document_path' => htmlspecialchars($documentById['document_path']),
        'document_title' => htmlspecialchars($documentById['document_title']),
    );

    
}


?>