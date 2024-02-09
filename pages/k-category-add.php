<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/k-category.request.php" method="post" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label class="form-label">Kategori Tipi</label>
                        <select name="category_type" class="form-select" required>
                            <option selected>Kategori Tipi Seçiniz..</option>
                            <option value="tinyhouse">Tiny House</option>
                            <option value="tinyticari">Tiny Ticari</option>
                            <option value="karavan">Karavan</option>
                            <option value="romork">Römork</option>
                            <option value="marin">Marin</option>
                        </select>
                    </div>
                    
                    

                    <div class="mb-3">
                        <label class="form-label">Ürün Açıklaması</label>
                        <input class="form-control" type="text" name="category_name" >
                    </div>

                   

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_k_category" class="btn btn-primary">Kaydet</button>
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