<?php if ($_GET['success'] == "true") {?>
    <div class="alert alert-primary mt-4" role="alert">İşlem Başarılı..</div>
<?php } else if ($_GET['error'] == "true") {?>
    <div class="alert alert-danger mt-4" role="alert">İşlem Başarısız..</div>
<?php } ?>