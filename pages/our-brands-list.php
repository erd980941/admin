<?php include '_header.php' ?>
<?php include '../_business/our-brands.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Markalarımız</h6>
                    </div>
                    <div class="col-6 text-end"><a href="our-brands-add" class="btn btn-primary">
                            <i class="fa-solid fa-file"></i> Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Firma Foto</th>
                                <th>Firma Adı</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ourBrands as $key=>$brand): ?>
                                <tr class="align-middle">
                                    <td width="50" class="text-center">
                                        <?php echo $key+1 ?>
                                    </td>
                                    <td width="150"><img
                                            src="../../assets/img/our-brands/<?php echo $brand['brand_image'] ? $brand['brand_image'] : 'no-image.jpg' ?>"
                                            class="img-responsive" width="150"></td>
                                    <td>
                                        <?php echo $brand['brand_title'] ?>
                                    </td>
                                    <td width="200" class="text-center">
                                        <a  href="our-brands-edit?brand_id=<?php echo $brand['brand_id'] ?>&edit=true"
                                            class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Düzenle</a>
                                        <a href="../_business/our-brands.request.php?brand_id=<?php echo $brand['brand_id'] ?>&delete=true"
                                            class="btn btn-danger"><i class="fa-solid fa-trash"></i> Sil</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include '_footer.php' ?>