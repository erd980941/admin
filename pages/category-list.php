<?php include '_header.php' ?>
<?php include '../_business/category.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
                    </div>
                    <div class="col-6 text-end"><a href="category-add" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Ana Kategori Ekle</a>
                    </div>
                </div>
            </div>
            
            <!-- Card Content - Collapse -->
            <div class="card-body">
                <?php include 'views/category-tree.php' ?>

            </div>
        </div>
    </div>
</div>


<?php include '_footer.php' ?>
