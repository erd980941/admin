<?php
require_once __DIR__.'/../_data_access/db-connector.php'; // Veritabanı bağlantısını sağlayan dosya

class KCategory
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function createCategory($categoryData)
    {
        $query = "INSERT INTO k_categories SET 
                    category_name = :category_name,
                    category_url = :category_url,
                    category_type = :category_type";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_name', $categoryData['category_name'], PDO::PARAM_STR);
        $statement->bindParam(':category_url', $categoryData['category_url'], PDO::PARAM_STR);
        $statement->bindParam(':category_type', $categoryData['category_type'], PDO::PARAM_STR);
        return $statement->execute();
    }

    public function updateCategory($categoryData)
    {
        $query = 'UPDATE k_categories SET 
                        category_name = :category_name,
                        category_url = :category_url,
                        category_type = :category_type
                        WHERE k_category_id=:k_category_id';

        $statement = $this->db->prepare($query);
        $statement->bindParam(':category_name', $categoryData['category_name'], PDO::PARAM_STR);
        $statement->bindParam(':category_url', $categoryData['category_url'], PDO::PARAM_STR);
        $statement->bindParam(':category_type', $categoryData['category_type'], PDO::PARAM_STR);
        $statement->bindParam(':k_category_id', $categoryData['k_category_id'],PDO::PARAM_INT);
        return $statement->execute();
    }

    public function getCategories()
    {
        $query = "SELECT * FROM k_categories ORDER BY k_category_id DESC";
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($categoryId)
    {
        $query = "SELECT * FROM k_categories WHERE k_category_id=:k_category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':k_category_id', $categoryId);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category ? $category : null;
    }


    public function deleteCategory($categoryId)
    {
        $query = "DELETE FROM k_categories WHERE k_category_id = :k_category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':k_category_id', $categoryId,PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoryByUrl($categoryUrl)
{
    $query = "SELECT * FROM k_categories WHERE category_url = :category_url";
    $statement = $this->db->prepare($query);
    $statement->bindParam(':category_url', $categoryUrl, PDO::PARAM_STR);


    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    
}



}
?>