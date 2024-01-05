<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Marka Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/our-brands.request.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Marka Foto</label>
                        <input class="form-control" type="file" id="formFile" name="brand_image" required>
                        <div  class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png ), Dosya En Boy Oranı 3:2 Olmalıdır.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Marka Foto Açıklama (Firma Adı)</label>
                        <input class="form-control" type="text" id="formFile" name="brand_title">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_our_brands" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>