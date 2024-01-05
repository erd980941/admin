<select name="parent_id" class="form-select">
    <option value="" <?php echo empty($categoryData['parent_id']) ? 'selected' : ''; ?>>Ana Kategori</option>
    <?php
    function displayCategoriesWithOptions($categories, $parentId = null, $indent = 0, $selectedCategoryId = null)
    {
        foreach ($categories as $cat) {
            if ($cat['parent_id'] == $parentId) {
                echo '<option value="' . $cat['category_id'] . '"';
                if ($cat['category_id'] == $selectedCategoryId) {
                    echo ' selected';
                }
                echo '>';
                echo str_repeat('&nbsp;', $indent * 4) . $cat['category_title'];
                echo '</option>';

                // Recursive call for subcategories with increased indent
                displayCategoriesWithOptions($categories, $cat['category_id'], $indent + 1, $selectedCategoryId);
            }
        }
    }
    $selectedCategoryId = isset($categoryData['parent_id']) ? $categoryData['parent_id'] : null;
    displayCategoriesWithOptions($categories, null, 0, $selectedCategoryId);
    ?>
</select>