<?php
require_once __DIR__ . '/../_data_access/db-connector.php';

class KProduct
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function getProducts()
    {
        $query = "SELECT * FROM k_products ORDER BY k_product_id DESC";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductById($productId)
    {
        $query = "SELECT * FROM k_products WHERE k_product_id=:k_product_id LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":k_product_id", $productId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function getDetailPDFByProductId($productId)
    {
        $query = "SELECT k_product_id,detail_pdf,product_name FROM k_products WHERE k_product_id=:k_product_id LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":k_product_id", $productId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function updateDetailPDF($producData)
    {
        $query = "UPDATE k_products SET detail_pdf=:detail_pdf WHERE k_product_id=:k_product_id LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":k_product_id", $producData['k_product_id'], PDO::PARAM_INT);
        $statement->bindParam(":detail_pdf", $producData['detail_pdf'], PDO::PARAM_STR);
        return $statement->execute();
        
    }
    public function deleteProductPdf($productId)
    {
        $query = "UPDATE k_products SET detail_pdf = NULL WHERE k_product_id = :k_product_id LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindValue(":k_product_id", $productId, PDO::PARAM_INT);
        return $statement->execute();
    }
    public function addProduct($productData)
    {
        $query = "INSERT INTO k_products SET 
                        product_name=:product_name,
                        product_short_description=:product_short_description,
                        product_description=:product_description,
                        product_properties=:product_properties,
                        product_url=:product_url,
                        product_link=:product_link,
                        product_featured=:product_featured,
                        k_category_id=:k_category_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":product_name", $productData["product_name"], PDO::PARAM_STR);
        $statement->bindParam(":product_short_description", $productData["product_short_description"], PDO::PARAM_STR);
        $statement->bindParam(":product_description", $productData["product_description"], PDO::PARAM_STR);
        $statement->bindParam(":product_properties", $productData["product_properties"], PDO::PARAM_STR);
        $statement->bindParam(":product_url", $productData["product_url"], PDO::PARAM_STR);
        $statement->bindParam(":product_link", $productData["product_link"], PDO::PARAM_STR);
        $statement->bindParam(":product_featured", $productData["product_featured"], PDO::PARAM_STR);
        $statement->bindParam(":k_category_id", $productData["k_category_id"], PDO::PARAM_INT);
        return $statement->execute();
    }
    public function updateProduct($productData)
    {
        $query = "UPDATE k_products SET
                         product_name=:product_name,
                        product_short_description=:product_short_description,
                        product_description=:product_description,
                        product_properties=:product_properties,
                        product_url=:product_url,
                        product_link=:product_link,
                        product_featured=:product_featured,
                        k_category_id=:k_category_id
                        WHERE k_product_id=:k_product_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":k_product_id", $productData["k_product_id"], PDO::PARAM_INT);
        $statement->bindParam(":product_name", $productData["product_name"], PDO::PARAM_STR);
        $statement->bindParam(":product_short_description", $productData["product_short_description"], PDO::PARAM_STR);
        $statement->bindParam(":product_description", $productData["product_description"], PDO::PARAM_STR);
        $statement->bindParam(":product_properties", $productData["product_properties"], PDO::PARAM_STR);
        $statement->bindParam(":product_url", $productData["product_url"], PDO::PARAM_STR);
        $statement->bindParam(":product_link", $productData["product_link"], PDO::PARAM_STR);
        $statement->bindParam(":product_featured", $productData["product_featured"], PDO::PARAM_STR);
        $statement->bindParam(":k_category_id", $productData["k_category_id"], PDO::PARAM_INT);
        return $statement->execute();
    }

    public function updateProductMainPhoto($productId, $mainPhotoId)
    {
        $query = "UPDATE k_products SET main_photo_id=:main_photo_id WHERE k_product_id=:k_product_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":k_product_id", $productId, PDO::PARAM_INT);
        $statement->bindParam(":main_photo_id", $mainPhotoId, PDO::PARAM_INT);
        return $statement->execute();
    }


    public function deleteProduct($productId)
    {
        $query = "DELETE FROM k_products WHERE k_product_id=:k_product_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":k_product_id", $productId, PDO::PARAM_INT);
        return $statement->execute();
    }

}
?>