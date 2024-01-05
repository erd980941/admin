<?php
require_once __DIR__.'/../_data_access/db-connector.php';

class OurBrands
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }


    public function getAllBrands()
    {
        $query = "SELECT * FROM our_brands ORDER BY brand_id DESC";
        $statement = $this->db->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getBrandById($brandId)
    {
        $query = "SELECT * FROM our_brands WHERE brand_id=:brand_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':brand_id', $brandId);
        $statement->execute();
        $brand = $statement->fetch(PDO::FETCH_ASSOC);
        return $brand ? $brand : null;

    }
    public function getBrandImagePathById($brandId){
        $query = 'SELECT brand_image FROM our_brands WHERE brand_id=:brand_id';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':brand_id', $brandId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return isset($result['brand_image'])?$result['brand_image']:null;
    }
    public function addBrand($brandData)
    {
        $query = "INSERT INTO our_brands SET brand_image = :brand_image, brand_title=:brand_title";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':brand_image', $brandData['brand_image']);
        $statement->bindParam(':brand_title', $brandData['brand_title']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBrand($brandData,$brandId)
    {
        $query = "UPDATE our_brands SET  brand_title=:brand_title WHERE brand_id=:brand_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':brand_title', $brandData['brand_title']);
        $statement->bindParam(':brand_id', $brandId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBrandImage($brandImage,$brandId){
        $query = "UPDATE our_brands SET brand_image = :brand_image WHERE brand_id =:brand_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':brand_image', $brandImage);
        $statement->bindParam(':brand_id', $brandId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBrand($brandId) {
        $query = "DELETE FROM our_brands WHERE brand_id = :brand_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':brand_id', $brandId);
    
        if ($statement->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    
}
?>