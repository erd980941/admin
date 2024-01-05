<?php
require_once __DIR__.'/../_classes/gallery-item.class.php';

$galleryItemModel = new GalleryItem();

$galleryItems = $galleryItemModel->getGalleryItems();


function paginateItems($items, $itemsPerPage, $currentPage) {
    $totalItems = count($items);

    // Toplam sayfa sayısını bulma
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Hangi öğelerin gösterileceğini belirleme
    $offset = ($currentPage - 1) * $itemsPerPage;
    $paginatedItems = array_slice($items, $offset, $itemsPerPage);

    return [
        'paginatedItems' => $paginatedItems,
        'totalPages' => $totalPages
    ];
}
$itemsPerPage = 12; // Her sayfada gösterilecek ürün sayısı
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; //Mevcut Sayfayı Bulma
$paginationResult = paginateItems($galleryItems, $itemsPerPage, $current_page);
$galleryItems = $paginationResult['paginatedItems'];
$totalPages = $paginationResult['totalPages'];

?>