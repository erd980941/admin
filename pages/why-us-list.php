<?php include '_header.php' ?>
<?php include '../_business/why-us.response.php' ?> 
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Neden Biz?</h6> 
                    </div>
                    <div class="col-6 text-end">
                        <a href="why-us-add" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Ekle 
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Başlık</th> 
                                <th>İçerik</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($whyUsItems as $key => $item): ?> 
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td>
                                        <?php echo $item['why_us_title'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $item['why_us_content'] ?> 
                                    </td>
                                    <td width="150" class="text-center">
                                        <a href="why-us-edit?why_us_id=<?php echo $item['why_us_id'] ?>&edit=true"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i> Düzenle
                                        </a>
                                        <a href="../_business/why-us.request.php?why_us_id=<?php echo $item['why_us_id'] ?>&delete=true"
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
</div>
<?php include '_footer.php' ?>