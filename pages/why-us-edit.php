<?php include '_header.php' ?>
<?php include '../_business/why-us.response.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Neden Biz Düzenle</h6>
            </div>
            <div class="card-body">

                <form action="../_business/why-us.request.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Başlık</label>
                        <input class="form-control" type="text" name="why_us_title" value="<?php echo $whyUsItem['why_us_title'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">İçerik</label>
                        <textarea class="form-control" name="why_us_content" required><?php echo $whyUsItem['why_us_content'] ?></textarea>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <input type="hidden" name="why_us_id" value="<?php echo $whyUsItem['why_us_id'] ?>">
                        <button type="submit" name="edit_why_us" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '_footer.php' ?>
