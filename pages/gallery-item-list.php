<?php include '_header.php' ?>
<?php include '../_business/gallery-item.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Galeri</h6>
                    </div>
                    <div class="col-6 text-end"><a href="gallery-item-add" class="btn btn-primary">
                            <i class="fa-solid fa-images"></i> Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <?php foreach ($galleryItems as $item): ?>
                        <div class="col-lg-3 mb-4">
                            <div class="thumbnail">
                                <img src="../../assets/img/gallery/<?php echo $item['image_path'] ?>" class="img-responsive"
                                    style="width:100%">
                                <div class="caption mt-1">
                                    <a href="../_business/gallery-item.request.php?item_id=<?php echo $item['item_id'] ?>&delete=true"
                                        class="btn  btn-sm btn-danger btn-block"><i class="fa-solid fa-trash"></i> Sil</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-auto">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link"
                                        href="<?php echo generatePageLink(($current_page <= 1) ? 1 : ($current_page - 1), $_GET); ?>"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                function generatePageLink($page, $queryParams)
                                {
                                    $url = $_SERVER['PHP_SELF'] . '?page=' . $page;

                                    // Mevcut GET parametrelerini kontrol edin ve linklere ekleyin
                                    foreach ($queryParams as $key => $value) {
                                        if ($key !== 'page') {
                                            $url .= '&' . $key . '=' . $value;
                                        }
                                    }

                                    return $url;
                                }

                                ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="<?php echo generatePageLink($i, $_GET); ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?php echo ($current_page >= $totalPages) ? 'disabled' : ''; ?>">
                                    <a class="page-link"
                                        href="<?php echo generatePageLink(($current_page >= $totalPages) ? $totalPages : ($current_page + 1), $_GET); ?>"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include '_footer.php' ?>