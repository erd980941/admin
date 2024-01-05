<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Galeri Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/gallery-item.request.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Galeri İtemi</label>
                        <input class="form-control" type="file" id="formFile" name="image_path" required>
                        <div  class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png ), Dosya En Boy Oranı 16:9 Olmalıdır.</div>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_gallery_item" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>