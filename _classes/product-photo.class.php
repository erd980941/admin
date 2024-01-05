<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class ProductPhoto {
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }


        public function getProductPhotos(){
            $query = "SELECT * FROM product_photos ORDER BY photo_id";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductPhotoById($photoId){
            $query = "SELECT * FROM product_photos WHERE photo_id=:photo_id LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam("photo_id", $photoId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public function getPhotosByProductId($productId){
            $query = "SELECT * FROM product_photos WHERE product_id=:product_id ORDER BY photo_id DESC";
            $statement = $this->db->prepare($query);
            $statement->bindParam("product_id", $productId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addProductPhoto($photosData){
           $query="INSERT INTO product_photos SET photo_name=:photo_name, product_id=:product_id";
           $statement = $this->db->prepare($query);
           $statement->bindParam(":photo_name", $photosData['photo_name'], PDO::PARAM_STR);
           $statement->bindParam(":product_id", $photosData['product_id'], PDO::PARAM_INT);
           return $statement->execute();
        }
        public function deleteProductPhoto($photoId){
            $query= 'DELETE  FROM product_photos WHERE photo_id=:photo_id';
            $statement = $this->db->prepare($query);
            $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
            return $statement->execute();
        }

    }
?>