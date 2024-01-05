<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Belge Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/our-document.request.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Belge</label>
                        <input class="form-control" type="file" id="formFile" name="document_path" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Belge Adı</label>
                        <input class="form-control" type="text" id="formFile" name="document_title">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_our_document" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>