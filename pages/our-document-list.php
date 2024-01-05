<?php include '_header.php' ?>
<?php include '../_business/our-document.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Kalite ve Onay Belgelerimiz</h6>
                    </div>
                    <div class="col-6 text-end"><a href="our-document-add" class="btn btn-primary">
                            <i class="fa-solid fa-file"></i> Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <?php foreach ($ourdocuments as $key => $document): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" style="margin-bottom:0.3rem">
                                <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="false"
                                    aria-controls="collapse<?php echo $key; ?>">
                                    <?php echo $document['document_title']; ?>
                                </a>
                                <a href="our-document-edit?document_id=<?php echo $document['document_id'] ?>&edit=true"
                                    class="btn btn-sm btn-primary ms-3">
                                    <i class="fa-solid fa-pen-to-square"></i> Düzenle
                                </a>
                                <a onClick="confirmDelete(<?php echo $document['document_id'] ?>)"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i> Sil
                                </a>
                            </h2>
                            <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <iframe src="../../assets\documents\<?php echo $document['document_path'] ?>"
                                        width="100%" height="700px"></iframe>
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
                    Belgeyi silmek istediğinize emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(documentId) {
            $('#confirmationModal').modal('show');

            $('#confirmDeleteBtn').click(function () {
                // Kullanıcı "Sil" butonuna tıkladı, formu gönder
                window.location.href = "../_business/our-document.request.php?document_id=" + documentId + "&delete=true";
            });
        }
    </script>
    <?php include '_footer.php' ?>