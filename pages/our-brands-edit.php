<?php include '_header.php' ?>
<?php include '../_business/our-brands.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Marka Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">
                <img src="../../assets/img/our-brands/<?php echo $brandImage ?>" class="img-responsive" width="300">
                <hr>
                <form action="../_business/our-brands.request.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" id="formFile" name="brand_id" value="<?php echo $brandData['brand_id'] ?>" >
                    <div class="mb-3">
                        <label class="form-label">Marka Foto</label>
                        <input class="form-control" type="file" id="formFile" name="brand_image">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Marka Foto Açıklama (Firma Adı)</label>
                        <input class="form-control" type="text" id="formFile" name="brand_title" value="<?php echo $brandData['brand_title'] ?>" >
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="edit_our_brands" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>