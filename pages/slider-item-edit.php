<?php include '_header.php' ?>
<?php include '../_business/slider-item.response.php' ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Marka Ekle</h6>
      </div>
      <!-- Card Content - Collapse -->
      <div class="card-body">
        <?php if ($sliderData['slider_type'] == 'image'): ?>
          <img src="../../assets/img/slider/<?php echo $sliderPath ?>"
            class="img-responsive" width="200">
        <?php else: ?>
          <video width="300" class="object-fit-cover" height="200" muted autoplay loop>
            <source src="../../assets/img/slider/<?php echo $sliderPath ?>" type="video/mp4" />
          </video>
        <?php endif; ?>

        <hr>
        <form action="../_business/slider-item.request.php" method="post" enctype="multipart/form-data">
          <input class="form-control" type="hidden" id="formFile" name="slider_id"
            value="<?php echo $sliderData['slider_id'] ?>">
          <div class="mb-3">
            <label class="form-label">Marka Foto</label>
            <input class="form-control" type="file" id="formFile" name="slider_path">
            <div class="form-text">İzin Verilen Uzantılar ( jpg, jpeg, png, mp4 ), Dosya Boyutu 16:9 olmalıdır.</div>
            
          </div>
          <div class="mb-3">
            <label class="form-label">Slider İtemi Açıklaması (Slogan)</label>
            <input class="form-control" type="text" id="formFile" name="slider_title"
              value="<?php echo $sliderData['slider_title'] ?>">
          </div>
          <div class="mb-3">
            <div class="input-group">
              <button class="btn btn-outline-secondary" type="button" id="decreaseBtn">-</button>
              <input class="form-control" type="number" max="100" min="1" id="numberInput" name="order_priority"
                value="<?php echo $sliderData['order_priority'] ?>">
              <button class="btn btn-outline-secondary" type="button" id="increaseBtn">+</button>
            </div>
          </div>
          <div class="d-grid gap-2 mt-2">
            <button type="submit" name="edit_slider_item" class="btn btn-primary">Kaydet</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const numberInput = document.getElementById('numberInput');
    const decreaseBtn = document.getElementById('decreaseBtn');
    const increaseBtn = document.getElementById('increaseBtn');

    numberInput.addEventListener('input', () => {
      let currentValue = parseInt(numberInput.value);
      if (currentValue === 1) {
        decreaseBtn.classList.add('disabled');
        increaseBtn.classList.remove('disabled');
      } else if (currentValue === 100) {
        increaseBtn.classList.add('disabled');
        decreaseBtn.classList.remove('disabled');
      } else {
        decreaseBtn.classList.remove('disabled');
        increaseBtn.classList.remove('disabled');
      }
    });

    decreaseBtn.addEventListener('click', () => {
      let currentValue = parseInt(numberInput.value);
      if (currentValue > 1) {
        currentValue -= 1;
        numberInput.value = currentValue;
        if (currentValue === 1) {
          decreaseBtn.classList.add('disabled');
        }
        if (currentValue < 100) {
          increaseBtn.classList.remove('disabled');
        }
      }
    });

    increaseBtn.addEventListener('click', () => {
      let currentValue = parseInt(numberInput.value);
      currentValue += 1;
      numberInput.value = currentValue;
      if (currentValue > 1) {
        decreaseBtn.classList.remove('disabled');
      }
      if (currentValue === 100) {
        increaseBtn.classList.add('disabled');
      }
    });

    // Initial button states based on input value
    const initialValue = parseInt(numberInput.value);
    if (initialValue === 1) {
      decreaseBtn.classList.add('disabled');
    } else if (initialValue === 100) {
      increaseBtn.classList.add('disabled');
    }
  });
</script>

<?php include '_footer.php' ?>