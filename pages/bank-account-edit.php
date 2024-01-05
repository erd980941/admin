<?php include '_header.php' ?>
<?php include '../_business/bank-account.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Banka Hesabı Düzenle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/bank-account.request.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Banka Adı</label>
                                <input class="form-control" type="text" name="bank_name" value="<?php echo $bankAccount['bank_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hesap Adı</label>
                                <input class="form-control" type="text" name="account_name" value="<?php echo $bankAccount['account_name'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">IBAN</label>
                        <input class="form-control" type="text" name="account_iban" value="<?php echo $bankAccount['account_iban'] ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hesap No</label>
                                <input class="form-control" type="text" name="account_number" value="<?php echo $bankAccount['account_number'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Şube Kodu</label>
                                <input class="form-control" type="text" value="<?php echo $bankAccount['account_branch_code'] ?>" name="account_branch_code">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <input type="hidden" class="form-control" name="account_id" value="<?php echo $bankAccount['account_id'] ?>" >
                        <button type="submit" name="edit_bank_account" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>
<?php include '_footer.php' ?>