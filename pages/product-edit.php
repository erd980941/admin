<?php include '_header.php' ?>
<?php include '../_business/category.response.php'; ?>
<?php include '../_business/product.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ürün Düzenle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/product.request.php" method="post" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label class="form-label">Ürün Kategorisi</label>
                        <select name="category_id" class="form-select" required>
                            <option selected>Kategori Seçiniz..</option>
                            <?php
                            function displayCategoriesWithOptions($categories, $parentId = null, $indent = 0,$categoryId=null)
                            {
                                foreach ($categories as $cat) {
                                    if ($cat['parent_id'] == $parentId) {
                                        echo '<option value="' . $cat['category_id'] . '"';
                                        if ($cat['category_id'] == $categoryId) {
                                            echo ' selected';
                                        }
                                        echo '>';
                                        echo str_repeat('&nbsp;', $indent * 4) . $cat['category_title'];
                                        echo '</option>';
                        
                                        // Recursive call for subcategories with increased indent
                                        displayCategoriesWithOptions($categories, $cat['category_id'], $indent + 1,$categoryId);
                                    }
                                }
                            }
                            displayCategoriesWithOptions($categories, null, 0,$product['category_id']);
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ürün Adı</label>
                                <input class="form-control" type="text" name="product_name" value="<?php echo $product['product_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ürün Adedi</label>
                                <input class="form-control" type="number" name="product_quantity" value="<?php echo $product['product_quantity'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Ürün Fiyatı</label>
                                <div class="input-group">
                                <input class="form-control" type="number" name="original_price" value="<?php echo $product['original_price'] ?>" required>
                                    <span class="input-group-text">TL</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Promosyon Yüzdesi </label>
                                <div class="input-group">
                                    <input class="form-control" type="number" value="<?php echo $product['discount_rate'] ?>" name="discount_rate" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Promosyon Fiyatı </label>
                                <div class="input-group">
                                    <input class="form-control" type="number"  value="<?php echo $product['discounted_price'] ?>" name="discounted_price" disabled>
                                    <span class="input-group-text">TL</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ürün Açıklaması</label>
                        
                        <input class="form-control" type="text" name="product_description" value="<?php echo $product['product_description'] ?>" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ürün  Özellikleri</label>
                        <textarea class="editor" name="product_detail">
                            <?php echo $product['product_detail'] ?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Öne Çıkar</label>
                                <select name="product_featured" class="form-select" >
                                    <option value="1" <?php echo $product['product_featured']==1?'Selected':'' ?> >Aktif</option>
                                    <option value="0" <?php echo $product['product_featured']==0?'Selected':'' ?>>Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Promosyonlu Ürün</label>
                                <select name="product_promotion" class="form-select" >
                                    <option value="1" <?php echo $product['product_promotion']==1?'Selected':'' ?>>Aktif</option>
                                    <option value="0" <?php echo $product['product_promotion']==0?'Selected':'' ?>>Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <input  type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>" >
                        <button type="submit" name="edit_product" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Input alanlarını seç
        var productPriceInput = document.querySelector('input[name="original_price"]');
        var discountRateInput = document.querySelector('input[name="discount_rate"]');
        var discountedPriceInput = document.querySelector('input[name="discounted_price"]');

        // Input alanlarına değer değişikliklerini dinle
        productPriceInput.addEventListener('input', calculateDiscountedPrice);
        discountRateInput.addEventListener('input', calculateDiscountedPrice);

        // Sayfa yüklendiğinde hesaplama yap
        calculateDiscountedPrice();

        // Promosyonlu fiyatı hesapla ve göster
        function calculateDiscountedPrice() {
            var productPrice = parseFloat(productPriceInput.value);
            var discountRate = parseFloat(discountRateInput.value);

            // Eğer girdiler sayısal değilse veya boşsa, hesaplama yapma
            if (isNaN(productPrice) || isNaN(discountRate)) {
                discountedPriceInput.value = '';
                return;
            }

            var discountedPrice = productPrice - (productPrice * discountRate / 100);

            // Hesaplanan değeri input alanına yazdır
            discountedPriceInput.value = discountedPrice.toFixed(2); // İki ondalık basamak kullanarak formatla
        }
    });
</script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>
<script>
    // Form gönderilmeden önce kontrol yap
    function validateForm() {
        var selectedCategory = document.getElementsByName("category_id")[0].value;
        if (selectedCategory == "Kategori Seçiniz..") {
            alert("Lütfen bir kategori seçiniz.");
            return false; // Formu gönderme
        }
        return true; // Formu gönderme
    }
</script>
<?php include '_footer.php' ?>