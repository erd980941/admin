<?php include '_header.php' ?>
<?php include '../_business/magaza-slider.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Mağaza Slider</h6>
                    </div>
                    <div class="col-6 text-end"><a href="magaza-slider-add" class="btn btn-primary">
                            <i class="fa-solid fa-images"></i> Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Slider İtem</th>
                                <th>İtem Başlığı</th>
                                <th>İtem Url</th>
                                <th>Sıra</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sliderItems as $key => $item): ?>
                                <tr class="align-middle">
                                    <td width="50" class="text-center">
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td width="200">
                                        <img src="../../magaza/assets/img/slider/<?php echo $item['slider_path'] ? $item['slider_path'] : 'no-image.jpg' ?>"
                                            class="img-fluid">
                                    </td>
                                    <td>
                                        <?php echo $item['slider_title'] ?>
                                    </td>
                                    <td>
                                        <?php echo $item['slider_url'] ?>
                                    </td>
                                    <td width="150" class="text-center">
                                        <a href="../_business/magaza-slider.request.php?slider_id=<?php echo $item['slider_id'] ?>&decrease=true"
                                            class="decreaseBtn btn btn-primary">+</a>
                                        <b class="orderPriority mx-2" >
                                            <?php echo $item['order_priority'] ?>
                                        </b>
                                        <a href="../_business/magaza-slider.request.php?slider_id=<?php echo $item['slider_id'] ?>&increase=true"
                                             class="increaseBtn btn btn-primary">+</a>
                                    </td>
                                    <td width="180" class="text-center">
                                        <a href="magaza-slider-edit?slider_id=<?php echo $item['slider_id'] ?>&edit=true"
                                            class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                                            Düzenle</a>
                                        <a href="../_business/magaza-slider.request.php?slider_id=<?php echo $item['slider_id'] ?>&delete=true"
                                            class="btn  btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Sil</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderPriorities = document.getElementsByClassName('orderPriority');
            const decreaseBtns = document.getElementsByClassName('decreaseBtn');
            const increaseBtns = document.getElementsByClassName('increaseBtn');

            for (let i = 0; i < orderPriorities.length; i++) {
                let value = parseInt(orderPriorities[i].innerText);

                if (value <= 1) {
                    decreaseBtns[i].classList.add('disabled');
                    decreaseBtns[i].removeAttribute('href');
                } else if (value >= 100) {
                    increaseBtns[i].classList.add('disabled');
                    increaseBtns[i].removeAttribute('href');
                }
            }
        });

    </script>
    <?php include '_footer.php' ?>