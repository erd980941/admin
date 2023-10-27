<?php include '_header.php' ?>
<?php include '../_business/about-us.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#aboutUs" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Hakkımızda</h6>
            </a>
            <div class="collapse show" id="aboutUs" style="">
                <div class="card-body">
                    <img src="<?php echo $aboutUsImage ?>" class="img-responsive" width="300">
                    <hr>
                    <form action="../_business/about-us.request.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Fotoğraf</label>
                            <input type="file" class="form-control" name="about_image"
                                value="<?php echo $aboutUsData['about_image'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fotoğraf Açıklama</label>
                            <input type="text" class="form-control" name="about_image_alt"
                                value="<?php echo $aboutUsData['about_image_alt'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control" name="about_title"
                                value="<?php echo $aboutUsData['about_title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İçerik</label>
                            <!-- <textarea type="text" class="form-control" name="about_content"><?php echo $aboutUsData['about_content'] ?></textarea> -->
                            <textarea class="editor" name="about_content">
                                <?php echo $aboutUsData['about_content'] ?>
                            </textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="about_us_update" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>

<?php include '_footer.php' ?>