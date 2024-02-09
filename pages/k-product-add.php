<?php include '_header.php' ?>
<?php include '../_business/k-category.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ürün Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/k-product.request.php" method="post" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label class="form-label">Ürün Kategorisi</label>
                        <select name="k_category_id" class="form-select" required>
                            <option selected>Kategori Seçiniz..</option>
                            <?php foreach($categories as $category): ?> 
                                <option value="<?php echo $category['k_category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php endforeach; ?>                           
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Ürün Adı</label>
                                <input class="form-control" type="text" name="product_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Button Link</label>
                                <input class="form-control" type="text" name="product_link" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ürün Kısa Açıklaması</label>
                        <input class="form-control" type="text" name="product_short_description" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ürün  Özellikleri</label>
                        <textarea class="editor" name="product_properties">
                        </textarea>
                    </div>
                    <div class="mb-3">
                            <label class="form-label">Ürün Açıklama</label>
                            <textarea class="editor" id="ckEditor2" name="product_description">
                                
                            </textarea>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Öne Çıkar</label>
                        <select name="product_featured" class="form-select" >
                            <option value="1" >Aktif</option>
                            <option value="0" selected>Pasif</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_k_product" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>
<script>

    ClassicEditor
        .create(document.querySelector('#ckEditor2'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    // Form gönderilmeden önce kontrol yap
    function validateForm() {
        var selectedCategory = document.getElementsByName("k_category_id")[0].value;
        if (selectedCategory == "Kategori Seçiniz..") {
            alert("Lütfen bir kategori seçiniz.");
            return false; // Formu gönderme
        }
        return true; // Formu gönderme
    }
</script>
<?php include '_footer.php' ?>