<?php include '_header.php' ?>
<?php include '../_business/product-photo.response.php' ?>
<?php include '../_business/product.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ürün Fotoğrafı Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/product-photo.request.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Marka Foto</label>
                        <input class="form-control" type="file" id="formFile" name="product_photo[]" multiple required>
                        <div  class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png ), Dosya En Boy Oranı 1:1 Olmalıdır.</div>
                        <input class="form-control" type="hidden" name="product_id"
                            value="<?php echo $_GET['product_id'] ?>">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_product_photos" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ürün Fotoğrafları</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($photosDataByProductId as $photo): ?>
                        <div class="col-lg-3 mb-4">
                            <div class="thumbnail">
                                <img src="../../assets/img/products/<?php echo $photo['photo_name'] ?>"
                                    class="img-responsive" style="width:100%">
                                <div class="caption mt-1">
                                    <?php if ($photo['photo_id'] == $product['main_photo_id']): ?>
                                        <span class="btn btn-sm btn-info" style="width:49.46%;">Ana Resim</span>
                                    <?php else: ?>
                                        <a href="../_business/product-photo.request.php?main_photo_id=<?php echo $photo['photo_id'] ?>&product_id=<?php echo $product['product_id'] ?>"
                                            class="btn btn-sm btn-primary" style="width:49.46%;">Ana Resim Yap</a>
                                    <?php endif; ?>
                                    <a href="../_business/product-photo.request.php?photo_id=<?php echo $photo['photo_id'] ?>&product_id=<?php echo $product['product_id'] ?>&delete=true"
                                        class="btn btn-sm btn-danger" style="width:49.46%">Sil</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <?php include '_footer.php' ?>