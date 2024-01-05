<?php
session_start();
require_once __DIR__.'/../_classes/our-document.class.php';
require_once 'fonksiyon.php';
$ourDocumentsModel = new OurDocument();

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

//--------------------- Site Ayarları ---------------------
if (isset($_POST['add_our_document'])) {


    $uploadDirectory = "../../assets/documents/";
    $fileExtension = pathinfo($_FILES['document_path']['name'], PATHINFO_EXTENSION);
    $uploadedFile = $_FILES['document_path']['tmp_name'];
    $allowedExtensions = 'pdf';

    $newFileName = seo($_POST['document_title']) . "_" . date("YmdHis");


    if ($fileExtension != $allowedExtensions) {
        header("Location:../pages/our-document?error=invalid_extension");
        exit();
    }


    $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
    $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

    if (!$isUploaded) {
        $result = false;
        goto x;
    }


    $documentData = [
        'document_path' => $newFileName . '.' . $fileExtension,
        'document_title' => $_POST['document_title'],
    ];

    $result = $ourDocumentsModel->addDocument($documentData);

    x:

    if ($result) {
        header("Location:../pages/our-document-list?success=true");
        exit();
    } else {
        header("Location:../pages/our-document-list?error=true");
        exit();
    }
}

if (isset($_POST['edit_our_document'])) {

    $documentId = $_POST['document_id'];


    if (!empty($_FILES['document_path']['name'])) {
        $uploadDirectory = "../../assets/documents/";
        $fileExtension = pathinfo($_FILES['document_path']['name'], PATHINFO_EXTENSION);
        $uploadedFile = $_FILES['document_path']['tmp_name'];
        $allowedExtensions = 'pdf';

        $newFileName = seo($_POST['document_title']) . "_" . date("YmdHis");


        if ($fileExtension != $allowedExtensions) {
            header("Location:../pages/our-document?error=invalid_extension");
            exit();
        }

        

        $targetFile = $uploadDirectory . $newFileName . '.' . $fileExtension;
        $isUploaded = move_uploaded_file($uploadedFile, $targetFile);

        if (!$isUploaded) {
            $result = false;
            goto a;
        }

        $olddocumentImagePath = $ourDocumentsModel->getDocumentPathById($documentId);
        unlink($uploadDirectory . $olddocumentImagePath);
        $documentImage = $newFileName . '.' . $fileExtension;
        $resultImage = $ourDocumentsModel->updateDocumentPath($documentImage, $documentId);
    } else {
        $resultImage = true;
    }


    $documentData = [

        'document_title' => $_POST['document_title'],
    ];

    $result = $ourDocumentsModel->updateDocument($documentData, $documentId);

    a:

    if ($result && $resultImage) {
        header("Location:../pages/our-document-list?success=true");
        exit();
    } else {
        header("Location:../pages/our-document-list?error=true");
        exit();
    }
}

if (isset($_GET['document_id']) && $_GET['delete'] == 'true') {

    $documentId = $_GET['document_id'];



    $olddocumentImagePath = $ourDocumentsModel->getDocumentPathById($documentId);
    unlink("../../assets/documents/" . $olddocumentImagePath);

    $result = $ourDocumentsModel->deleteDocument($documentId);

    if ($result) {
        header("Location:../pages/our-document-list?success=true");
        exit();
    } else {
        header("Location:../pages/our-document-list?error=true");
        exit();
    }
}
?>