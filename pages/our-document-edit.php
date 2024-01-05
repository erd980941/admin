<?php include '_header.php' ?>
<?php include '../_business/our-document.response.php' ?>
<div class="row">

    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Belge Düzenle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">
                <form action="../_business/our-document.request.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" id="formFile" name="document_id"
                        value="<?php echo $documentData['document_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Belge</label>
                        <input class="form-control" type="file" id="formFile" name="document_image">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Belge Adı</label>
                        <input class="form-control" type="text" id="formFile" name="document_title"
                            value="<?php echo $documentData['document_title'] ?>">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="edit_our_document" class="btn btn-primary">Kaydet</button>
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
                <h6 class="m-0 font-weight-bold text-primary">LOGO</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="siteLogo" style="">
                <div class="card-body">
                    <iframe src="../../assets\documents\<?php echo $documentData['document_path'] ?>" width="100%"
                        height="500px"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>