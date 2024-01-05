<?php include '_header.php' ?>
<?php include '../_business/user.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kullanıcılar</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>E-Posta</th>
                                <th>Ad Soyad</th>
                                <th>İletişim Bilgileri</th>
                                <th>Durum</th>
                                <th>E-Posta Onayı</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user): ?>
                                <tr class="align-middle">
                                    <td width="50" class="text-center">
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td width="150">
                                        <?php echo $user['user_email'] ?>
                                    <td>
                                        <?php echo $user['user_first_name'] . " " . $user['user_last_name'] ?>
                                    </td>

                                    <td>
                                        <a href="user-contact?userId=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-primary" >
                                            Adresleri Göster
                                        </a>

                                    </td>
                                    <td width="50" class="text-center">
                                        <?php if ($user['user_status'] == 1): ?>
                                            <a href="../_business/user.request.php?user_id=<?php echo $user['user_id'] ?>&passive=true" class="btn btn-sm btn-success">Aktif</a>
                                        <?php else: ?>
                                            <a  href="../_business/user.request.php?user_id=<?php echo $user['user_id'] ?>&active=true" class="btn btn-sm btn-warning">Pasif</a>
                                        <?php endif; ?>
                                    </td>
                                    <td width="200" class="text-center">
                                        <?php if ($user['email_verified'] == 1): ?>
                                            <span style="width:100%" class="btn btn-sm btn-success">E-Posta Onaylandı</span>
                                        <?php else: ?>
                                            <span  style="width:100%" class="btn btn-sm btn-warning">E-Posta Onaylanmadı</span>
                                        <?php endif; ?>
                                    </td>
                                    <td width="260" class="text-center">
                                        
                                        <a onclick="confirmResetPassword(<?php echo $user['user_id'] ?>, '<?php echo $user['user_email'] ?>')" class="btn btn-sm btn-danger">
                                            Şifre Sıfırla / Mail Gönder
                                        </a>
                                        
                                        <a onClick="confirmDelete(<?php echo $user['user_id'] ?>)"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i> Sil
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
                   Kullanıcıyı sildiğinizde kullanıcıya ait veriler tamamen kaybolacaktır. Bu kullanıcı silmek istediğinize emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reserPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silme Onayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   Kullanıcının Şifresini Sıfırladığınızda Otomatik Bir Şifre Atıp Mail İle Kullanıcıya İletilecektir. Şifreyi Sıfırlamak İstediğinize Emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="resetPasswordBtn">Şifreyi Sıfırla</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmResetPassword(userId, userEmail) {
            $('#reserPasswordModal').modal('show');

            $('#resetPasswordBtn').click(function () {
                // Kullanıcı "Sil" butonuna tıkladı, formu gönder
                window.location.href = "../_business/user.request.php?user_id=" + userId + "&user_email="+userEmail+"&reset_password=true";
            });
        }
        function confirmDelete(userId) {
            $('#confirmationModal').modal('show');

            $('#confirmDeleteBtn').click(function () {
                // Kullanıcı "Sil" butonuna tıkladı, formu gönder
                window.location.href = "../_business/user.request.php?user_id=" + userId + "&delete=true";
            });
        }

    </script>
    <?php include '_footer.php' ?>