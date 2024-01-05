<?php include '_header.php' ?>
<?php include '../_business/user-contact.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Adresleri</h6>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <?php foreach ($userAddresses as $key => $address): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="false"
                                    aria-controls="collapse<?php echo $key; ?>">
                                    <?php echo $address['contact_title']; ?>
                                    <a onClick="confirmDelete(<?php echo $address['contact_id'] ?>)"
                                        class="btn btn-sm btn-danger ms-3">
                                        <i class="fa-solid fa-trash"></i> Sil
                                    </a>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <b>İl : </b>
                                    <?php echo $address['contact_city']; ?><br>
                                    <b>İlçe : </b>
                                    <?php echo $address['contact_district']; ?><br>
                                    <b>Adres : </b>
                                    <?php echo $address['contact_address']; ?><br>
                                    <b>Posta Kodu : </b>
                                    <?php echo $address['postal_code']; ?><br>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                    Kullanıcıya ait adresi silmek istediğinize emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(contactId) {
            $('#confirmationModal').modal('show');

            $('#confirmDeleteBtn').click(function () {
                // Kullanıcı "Sil" butonuna tıkladı, formu gönder
                window.location.href = "../_business/user-contact.request.php?contact_id=" + contactId + "&delete=true";
            });
        }
    </script>


    
    <?php include '_footer.php' ?>