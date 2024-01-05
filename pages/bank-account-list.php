<?php include '_header.php' ?>
<?php include '../_business/bank-account.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Banka Hesapları</h6>
                    </div>
                    <div class="col-6 text-end"><a href="bank-account-add" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Hesap Ekle</a>
                    </div>
                </div>
            </div>

            <!-- Card Content - Collapse -->
            <div class="card-body">
                <div class="row">

                    <?php foreach ($bankAccounts as $account): ?>

                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <h5 class="card-header d-flex justify-content-between align-items-center">
                                    <span>
                                        <?php echo $account['bank_name'] ?>
                                    </span>
                                    <div>
                                        <a href="bank-account-edit?account_id=<?php echo $account['account_id'] ?>&edit=true"
                                            class="btn btn-sm btn-primary ms-3">
                                            <i class="fa-solid fa-pen-to-square"></i> Düzenle
                                        </a>
                                        <a onClick="confirmDelete(<?php echo $account['account_id'] ?>)"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i> Sil
                                        </a>
                                    </div>
                                </h5>
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b>Hesap Adı</b></td>
                                                <td>:
                                                    <?php echo $account['account_name'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Hesap No</b></td>
                                                <td>:
                                                    <?php echo $account['account_number'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Hesap IBAN</b></td>
                                                <td>:
                                                    <?php echo $account['account_iban'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Şube Kodu</b></td>
                                                <td>:
                                                    <?php echo $account['account_branch_code'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="d-grid gap-2">
                                        <?php if ($account['account_enabled']): ?>
                                            <span href="#" class="btn btn-success"><i class="fa-solid fa-building-columns"></i>
                                                Etkin Banka Hesabı</span>
                                        <?php else: ?>
                                            <a href="../_business/bank-account.request.php?account_id=<?php echo $account['account_id'] ?>&enabled=true"
                                                class="btn btn-primary">
                                                <i class="fa-solid fa-building-columns"></i> Etkin Banka Hesabı Yap
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silme Onayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Banka hesap bilgilerini silmek istediğinize emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(accountId) {
            $('#confirmationModal').modal('show');

            $('#confirmDeleteBtn').click(function () {
                // Kullanıcı "Sil" butonuna tıkladı, formu gönder
                window.location.href = "../_business/bank-account.request.php?account_id=" + accountId + "&delete=true";
            });
        }
    </script>
<?php include '_footer.php' ?>