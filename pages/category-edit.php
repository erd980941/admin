<?php include '_header.php' ?>
<?php include '../_business/category.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/category.request.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Üst Kategori</label>
                        <?php include 'views/category-select.php' ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Adı</label>
                        <input class="form-control" type="text" name="category_title"
                            value="<?php echo $categoryData['category_title'] ?>">
                    </div>

                    <!-- Gizli alan ile parent ID'yi gönder -->
                    <input type="hidden" name="category_id" value="<?php echo $categoryData['category_id']; ?>">

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="edit_category" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>