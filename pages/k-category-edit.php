<?php include '_header.php' ?>
<?php include '../_business/k-category.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Düzenle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/k-category.request.php" method="post" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label class="form-label">Kategori Tipi</label>
                        <select name="category_type" class="form-select" required>
                            <option value="" selected disabled>Kategori Tipi Seçiniz..</option>
                            <option value="tinyhouse" <?php if ($categoryData['category_type'] === 'tinyhouse')
                                echo 'selected'; ?>>Tiny House</option>
                            <option value="tinyticari" <?php if ($categoryData['category_type'] === 'tinyticari')
                                echo 'selected'; ?>>Tiny Ticari</option>
                            <option value="karavan" <?php if ($categoryData['category_type'] === 'karavan')
                                echo 'selected'; ?>>Karavan</option>
                            <option value="romork" <?php if ($categoryData['category_type'] === 'romork')
                                echo 'selected'; ?>>Römork</option>
                            <option value="marin" <?php if ($categoryData['category_type'] === 'marin')
                                echo 'selected'; ?>>Marin</option>
                        </select>
                    </div>



                    <div class="mb-3">
                        <label class="form-label">Ürün Açıklaması</label>
                        <input class="form-control" type="text" value="<?php echo $categoryData['category_name'] ?>"
                            name="category_name">
                    </div>


                    <input type="hidden" name="k_category_id" value="<?php echo $categoryData['k_category_id'] ?>" >
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="edit_k_category" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/script.js"></script>
<script>
    // Form gönderilmeden önce kontrol yap
    function validateForm() {
        var selectedCategory = document.getElementsByName("category_type")[0].value;
        if (selectedCategory == "Kategori Tipi Seçiniz..") {
            alert("Lütfen bir kategori seçiniz.");
            return false; // Formu gönderme
        }
        return true; // Formu gönderme
    }
</script>
<?php include '_footer.php' ?>