<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class KProductPhoto {
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }


        public function getProductPhotos(){
            $query = "SELECT * FROM k_product_photos ORDER BY k_photo_id";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductPhotoById($photoId){
            $query = "SELECT * FROM k_product_photos WHERE k_photo_id=:k_photo_id LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam("k_photo_id", $photoId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public function getPhotosByProductId($productId){
            $query = "SELECT * FROM k_product_photos WHERE k_product_id=:k_product_id ORDER BY k_photo_id DESC";
            $statement = $this->db->prepare($query);
            $statement->bindParam("k_product_id", $productId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addProductPhoto($photosData){
           $query="INSERT INTO k_product_photos SET photo_name=:photo_name, k_product_id=:k_product_id";
           $statement = $this->db->prepare($query);
           $statement->bindParam(":photo_name", $photosData['photo_name'], PDO::PARAM_STR);
           $statement->bindParam(":k_product_id", $photosData['k_product_id'], PDO::PARAM_INT);
           return $statement->execute();
        }
        public function deleteProductPhoto($photoId){
            $query= 'DELETE  FROM k_product_photos WHERE k_photo_id=:k_photo_id';
            $statement = $this->db->prepare($query);
            $statement->bindParam(':k_photo_id', $photoId, PDO::PARAM_INT);
            return $statement->execute();
        }

    }
?>