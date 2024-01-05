<?php
function hasChildren($categories, $parentId)
{
    foreach ($categories as $cat) {
        if ($cat['parent_id'] == $parentId) {
            return true;
        }
    }
    return false;
}

function displayCategories($categories, $parentId = null)
{
    foreach ($categories as $cat) {
        if ($cat['parent_id'] == $parentId) {
            echo '<div>';
            echo '<button class="btn btn-primary my-2"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse_' . $cat['category_id'] . '">';
            echo $cat['category_title'];
            echo '<a href="category-add?parent_id=' . $cat['category_id'] . '" class="btn btn-sm btn-info ms-3" ><i class="fa-solid fa-plus"></i></a>';
            echo '<a href="category-edit?category_id=' . $cat['category_id'] . '&edit=true" class="btn btn-sm btn-warning ms-2" ><i class="fa-solid fa-pen-to-square"></i></a>';
            echo '<a onClick="confirmDelete('.$cat['category_id'].')"  class="btn btn-sm btn-danger ms-2" ><i class="fa-solid fa-trash-can"></i></a>'; 
            echo '<a href="product-add?category_id=' . $cat['category_id'] . '" class="btn btn-sm btn-info ms-2" ><i class="fa-solid fa-box"></i></a>';
            echo '</button>';


            if (hasChildren($categories, $cat['category_id'])) {
                echo '<div class="collapse" id="collapse_' . $cat['category_id'] . '">';
                echo '<div class="card card-body">';

                // Recursive call for subcategories
                displayCategories($categories, $cat['category_id']);

                echo '</div>';
                echo '</div>';

            }
            echo '</div>';
        }
    }
}
?>

<?php displayCategories($categories); ?>
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Silme Onayı</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bu kategoriyi sildiğinizde bu kategoriye ait diğer alt kategoriler ve ilgili kategorilere ait ürünlerde silinecektir. Silme işlemine devam etmek istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
      </div>
    </div>
  </div>
</div>

<script>
function confirmDelete(categoryId) {
    $('#confirmationModal').modal('show');
    
    $('#confirmDeleteBtn').click(function() {
        // Kullanıcı "Sil" butonuna tıkladı, formu gönder
        window.location.href = "../_business/category.request.php?category_id=" + categoryId + "&delete=true";
    });
}


</script>