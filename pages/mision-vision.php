<?php include '_header.php' ?>
<?php include '../_business/mision-vision.response.php' ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#misison" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Misyonumuz</h6>
            </a>
            <div class="collapse show" id="misison" style="">
                <div class="card-body">
                    <img src="../../assets/img/<?php echo $misionImage ?>" class="img-responsive" width="300">
                    <hr>
                    <form action="../_business/mision-vision.request.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="mv_type" value="<?php echo $mision['mv_type'] ?>" >
                        <div class="mb-3">
                            <label class="form-label">Fotoğraf</label>
                            <input type="file" class="form-control" name="mv_image">
                            <div  class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png ), Dosya En Boy Oranı 3:2 Olmalıdır.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Misyon Başlık</label>
                            <input type="text" class="form-control" name="mv_title" value="<?php echo $mision['mv_title'] ?>" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Misyon İçerik</label>
                            <textarea class="editor" id="ckEditor" name="mv_content">
                                <?php echo $mision['mv_content'] ?>
                            </textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary"  name="mision_vision_update" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#vision" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Vizyonumuz</h6>
            </a>
            <div class="collapse show" id="vision" style="">
                <div class="card-body">
                    <img src="../../assets/img/<?php echo $visionImage ?>" class="img-responsive" width="300">
                    <hr>
                    <form action="../_business/mision-vision.request.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="mv_type" value="<?php echo $vision['mv_type'] ?>" >
                        <div class="mb-3">
                            <label class="form-label">Fotoğraf</label>
                            <input type="file" class="form-control" name="mv_image">
                            <div  class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png ), Dosya En Boy Oranı 3:2 Olmalıdır.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vizyon Başlık</label>
                            <input type="text" class="form-control" name="mv_title" value="<?php echo $vision['mv_title'] ?>" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vizyon İçerik</label>
                            <textarea class="editor" id="ckEditor2" name="mv_content">
                                <?php echo $vision['mv_content'] ?>
                            </textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="mision_vision_update" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>
<script>

    ClassicEditor
        .create(document.querySelector('#ckEditor2'))
        .catch(error => {
            console.error(error);
        });
</script>

<?php include '_footer.php' ?>