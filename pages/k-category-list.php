<?php include '_header.php' ?>
<?php include '../_business/k-category.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
                    </div>
                    <div class="col-6 text-end"><a href="k-category-add" class="btn btn-primary">
                        <i class="fa-solid fa-box"></i> Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Kategori Adı</th>
                                <th>Kategori Tip</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $key => $category): ?>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td>
                                        <?php echo $category['category_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $category['category_type'] ?>
                                    </td>
                                    <td width="150" class="text-center">
                                        <a href="k-category-edit?k_category_id=<?php echo $category['k_category_id'] ?>&edit=true"
                                            class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                                            Düzenle</a>
                                        <a href="../_business/k-category.request.php?k_category_id=<?php echo $category['k_category_id'] ?>&delete=true"
                                            class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Sil</a>
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