<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Banka Hesabı Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/bank-account.request.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Para Birimi</label>
                                <select name="currency_type" class="form-select">
                                    <option value="TRY" selected>TRY</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Banka Adı</label>
                                <input class="form-control" type="text" name="bank_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hesap Adı</label>
                                <input class="form-control" type="text" name="account_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">IBAN</label>
                        <input class="form-control" type="text" name="account_iban" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hesap No</label>
                                <input class="form-control" type="text" name="account_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Şube Kodu</label>
                                <input class="form-control" type="text" name="account_branch_code">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Etkinleştirilmiş Hesap</label>
                        <select name="account_enabled" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0" selected>Pasif</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_bank_account" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>
<?php include '_footer.php' ?>