<?php include '_header.php' ?>
<?php include '../_business/k-product.response.php' ?>
<div class="row">

    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detay PDF Düzenle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">
                <form action="../_business/k-product.request.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" id="formFile" name="k_product_id"
                        value="<?php echo $product['k_product_id'] ?>">
                    <input class="form-control" type="hidden" id="formFile" name="product_name"
                        value="<?php echo $product['product_name'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Belge</label>
                        <input class="form-control" type="file" id="formFile" name="detail_pdf">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="edit_k_product_pdf" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#siteLogo" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true">
                <h6 class="m-0 font-weight-bold text-primary">Belge</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="siteLogo" style="">
                <div class="card-body">
                    
                    <?php if(!empty($product['detail_pdf'])): ?>
                        <form action="../_business/k-product.request.php" method="post" >
                            <input type="hidden" name="k_product_id" value="<?php echo $product['k_product_id'] ?>" >
                            <input type="hidden" name="old_detail_pdf" value="<?php echo $product['detail_pdf'] ?>" >
                            <button type="submit" name="k_product_delete_pdf" class="btn btn-block btn-danger mb-3">Sil</button>
                        </form>
                        <iframe src="../../assets/documents/products/<?php echo $product['detail_pdf'] ?>" width="100%"
                            height="500px"></iframe>
                    <?php else: ?>
                        <h2>Yüklü Detay Belge Bulunmamaktadır.</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>