<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#siteLogo" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">LOGO</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show " id="siteLogo" style="">
                <div class="card-body">
                    <img src="../../assets/img/<?php echo $siteLogoPath ?>" class="img-responsive" width="300">
                    <hr class="my-4">
                    <form  class="mt-5" action="../_business/site-settings.request.php" method="post" enctype="multipart/form-data">
                        <input class="form-control" type="file" id="formFile" name="site_logo">
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" name="site_logo" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#siteSettings" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Site Ayarları</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="siteSettings" style="">
                <div class="card-body">
                    <form action="../_business/site-settings.request.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Site Başlık (Title)</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_title'] ?>" name="site_title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Site Açıklama (Description)</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_description'] ?>"
                                        name="site_description">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Site Anahtar Kelime (Keywords)</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_keywords'] ?>" name="site_keywords">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Site Yazar (Author)</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_author'] ?>" name="site_author">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Zopim</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_zopim'] ?>" name="site_zopim">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Maps</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_maps'] ?>" name="site_maps">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Site URL</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsData['site_url'] ?>" name="site_url">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="site_settings" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#siteEmail" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Email Ayarları</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="siteEmail" style="">
                <div class="card-body">
                    <form action="../_business/site-settings.request.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Smtp Host</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsEmailData['site_smtpHost'] ?>"
                                        name="site_smtpHost">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Smtp Port</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsEmailData['site_smtpPort'] ?>"
                                        name="site_smtpPort">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Smtp User</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsEmailData['site_smtpUser'] ?>"
                                        name="site_smtpUser">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Smpt Password</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteSettingsEmailData['site_smtpPassword'] ?>"
                                        name="site_smtpPassword">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control"
                                value="<?php echo $siteSettingsEmailData['site_smtpEmail'] ?>" name="site_smtpEmail">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit" name="site_email">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#siteContactInformation" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">İletişim Ayarları</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="siteContactInformation" style="">
                <div class="card-body">
                    <form action="../_business/site-settings.request.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">İl</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteContactInformationData['site_city'] ?>" name="site_city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">İlçe</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $siteContactInformationData['site_district'] ?>"
                                        name="site_district">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tel</label>
                            <input type="text" class="form-control"
                                value="<?php echo $siteContactInformationData['site_tel'] ?>" name="site_tel">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adres</label>
                            <textarea class="form-control"
                                name="site_address"><?php echo $siteContactInformationData['site_address'] ?></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="site_contact_information"
                                type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>