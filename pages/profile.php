<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#adminUsername" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Adını Güncelle</h6>
            </a>
            <div class="collapse show" id="adminUsername" style="">
                <div class="card-body">
                    <form action="../_business/adminProfile.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Kullanıcı Adı</label>
                            <input type="text" class="form-control" name="admin_username">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="admin_changeUsername"
                                type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#adminPassword" class="d-block card-header py-3" data-toggle="collapse" role="button">
                <h6 class="m-0 font-weight-bold text-primary">Şifre Değiştir</h6>
            </a>
            <div class="collapse show" id="adminPassword" style="">
                <div class="card-body">
                    <form action="../_business/adminProfile.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Eski Şifre</label>
                            <input type="text" class="form-control" name="currentPassword" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yeni Şifre</label>
                            <input type="text" class="form-control" name="newPassword" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yeni Şifre Tekrar</label>
                            <input type="text" class="form-control" name="verifyPassword" >
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" name="admin_changePassword" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>