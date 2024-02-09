<?php include '_header.php' ?>
<?php include '../_business/k-product.response.php' ?>
<?php include '../_business/k-category.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Ürünler</h6>
                    </div>
                    <div class="col-6 text-end"><a href="k-product-add" class="btn btn-primary">
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
                                <th>Resim</th>
                                <th>Detay PDF</th>
                                <th>Kategori Adı</th>
                                <th>Ürün Adı</th>
                                <th>Ürün Açıklama</th>
                                <th>Öne.Çık.</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $key => $product): ?>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td width="115" class="text-center" >
                                        <a href="k-product-photos?k_product_id=<?php echo $product['k_product_id'] ?>"
                                            class="btn btn-sm btn-primary">Resim İşlemleri</a>
                                    </td>
                                    <td width="115" class="text-center" >
                                        <a href="k-product-pdf?k_product_id=<?php echo $product['k_product_id'] ?>&edit_pdf=true"
                                            class="btn btn-sm btn-primary">Detay PDF</a>
                                    </td>
                                       <td>
                                       <?php
                                        $category = $categoryModel->getCategoryById($product['k_category_id']);
                                        echo $category['category_name']
                                        ?>
                                       </td>
                                    </td>
                                    <td>
                                        <?php echo $product['product_name'] ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $product['product_short_description'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($product['product_featured'] == 1): ?>
                                            <span class="btn btn-sm btn-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="btn btn-sm btn-warning">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td width="150" class="text-center">
                                        <a href="k-product-edit?k_product_id=<?php echo $product['k_product_id'] ?>&edit=true"
                                            class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                                            Düzenle</a>
                                        <a href="../_business/k-product.request.php?k_product_id=<?php echo $product['k_product_id'] ?>&delete=true"
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