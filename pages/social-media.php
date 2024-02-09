<?php include '_header.php' ?>
<?php include '../_business/social-media.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#socialMedia" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Sosyal Medya</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="socialMedia" style="">
                <div class="card-body">
                    <form action="../_business/social-media.request.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['linkedin'] ?>"
                                        name="linkedin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                <label class="form-label">YouTube</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['youtube'] ?>"
                                        name="youtube">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['instagram'] ?>"
                                        name="instagram">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['facebook'] ?>" name="facebook">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Trendyol</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['trendyol'] ?>" name="trendyol">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Hepsiburada</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['hepsiburada'] ?>" name="hepsiburada">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">N11</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['n11'] ?>" name="n11">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sahibinden</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $socialMedia['sahibinden'] ?>" name="sahibinden">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="update_social_media" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>