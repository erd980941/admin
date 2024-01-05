<?php include '_header.php' ?>
<?php include '../_business/product.response.php' ?>
<?php include '../_business/category.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Ürünler</h6>
                    </div>
                    <div class="col-6 text-end"><a href="product-add" class="btn btn-primary">
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
                                <th>Kategori Adı</th>
                                <th>Ürün Adı</th>
                                <th>Fiyat</th>
                                <th>Stok</th>
                                <th>Öne.Çık.</th>
                                <th>Promosyon</th>
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
                                        <a href="product-photos?product_id=<?php echo $product['product_id'] ?>"
                                            class="btn btn-sm btn-primary">Resim İşlemleri</a>
                                    <td>
                                        <?php
                                        $nestedCategoriesByProduct = $categoryModel->getParentCategories($product['category_id']);
                                        $categoryTitles = array_column($nestedCategoriesByProduct, 'category_title');
                                        echo implode(' > ', $categoryTitles);
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $product['product_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $product['original_price'] ?>TL ->
                                        <?php echo $product['discount_rate'] ?>% -> 
                                        <?php echo $product['discounted_price'] ?>TL
                                    </td>
                                    <td>
                                        <?php echo $product['product_quantity'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($product['product_featured'] == 1): ?>
                                            <span class="btn btn-sm btn-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="btn btn-sm btn-warning">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($product['product_promotion'] == 1): ?>
                                            <span class="btn btn-sm btn-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="btn btn-sm btn-warning">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td width="150" class="text-center">
                                        <a href="product-edit?product_id=<?php echo $product['product_id'] ?>&edit=true"
                                            class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                                            Düzenle</a>
                                        <a href="../_business/product.request.php?product_id=<?php echo $product['product_id'] ?>&delete=true"
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