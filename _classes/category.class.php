<?php
require_once __DIR__.'/../_data_access/db-connector.php'; // Veritabanı bağlantısını sağlayan dosya

class Category
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function createCategory($categoryData)
    {
        //$query = "INSERT INTO categories (category_title, parent_id) VALUES (:title, :parent_id)";
        $query = "INSERT INTO categories SET category_title = :category_title, parent_id=:parent_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_title', $categoryData['category_title'], PDO::PARAM_STR);
        $statement->bindParam(':parent_id', $categoryData['parent_id']);
        return $statement->execute();
    }

    public function updateCategory($categoryData)
    {
        $query = 'UPDATE categories SET category_title=:category_title, parent_id=:parent_id WHERE category_id=:category_id';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_title', $categoryData['category_title'], PDO::PARAM_STR);
        $statement->bindParam(':parent_id', $categoryData['parent_id']);
        $statement->bindParam(':category_id', $categoryData['category_id']);
        return $statement->execute();
    }

    public function getCategories()
    {
        $query = "SELECT * FROM categories ORDER BY category_id";
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNestedCategories($parentId = null)
    {
        $query = "SELECT * FROM categories WHERE parent_id = :parent_id ORDER BY category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':parent_id', $parentId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParentCategories($categoryId)
    {
        $categories = [];

        $query = "SELECT * FROM categories WHERE category_id = :category_id LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);

        if ($category != null) {

            $categories = $this->getParentCategories($category['parent_id']);
            $categories[] = [
                'category_id' => $category['category_id'],
                'category_title' => $category['category_title'],
            ];
        }
        return $categories;
    }


    public function getCategoryById($categoryId)
    {
        $query = "SELECT * FROM categories WHERE category_id=:category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_id', $categoryId);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category ? $category : null;
    }

    public function deleteCategory($categoryId)
    {
        $query = "DELETE FROM categories WHERE category_id = :category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_id', $categoryId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategoryRecursive($categoryId)
    {
        // Alt kategorileri getir
        $subCategories = $this->getNestedCategories($categoryId);

        // Alt kategorileri sil
        foreach ($subCategories as $subCategory) {
            $this->deleteCategoryRecursive($subCategory['category_id']);
        }

        // Kategoriyi sil
        $query = "DELETE FROM categories WHERE category_id = :category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_id', $categoryId);

        return $statement->execute();
    }

}
?>