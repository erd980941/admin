<?php include '_header.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Slider Ekle</h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">

                <form action="../_business/slider-item.request.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Slider İtemi</label>
                        <input class="form-control" type="file" id="formFile" name="slider_path" required>
                        <div  class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png, mp4 ), Dosya En Boy Oranı 2:1 Olmalıdır.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slider İtemi Açıklaması (Slogan)</label>
                        <input class="form-control" type="text" id="formFile" name="slider_title">
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Slider İtem Sırası</label>
                        <input class="form-control" type="number"  value="1" min="1" max="100" name="order_priority">
                    </div> -->
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="add_slider_item" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '_footer.php' ?>