<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class Product {
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }

        public function getProducts(){
            $query = "SELECT * FROM products ORDER BY product_id DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getProductById($productId){
            $query = "SELECT * FROM products WHERE product_id=:product_id LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":product_id", $productId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public function addProduct($productData){
            $query="INSERT INTO products SET 
                        product_name=:product_name,
                        original_price=:original_price,
                        discount_rate=:discount_rate,
                        discounted_price=:discounted_price,
                        product_quantity=:product_quantity,
                        product_description=:product_description,
                        product_detail=:product_detail,
                        product_featured=:product_featured,
                        product_promotion=:product_promotion,
                        category_id=:category_id";
            $statement=$this->db->prepare($query);
            $statement->bindParam(":product_name", $productData["product_name"], PDO::PARAM_STR);
            $statement->bindParam(":original_price", $productData["original_price"], PDO::PARAM_INT);
            $statement->bindParam(":discount_rate", $productData["discount_rate"], PDO::PARAM_INT);
            $statement->bindParam(":discounted_price", $productData["discounted_price"], PDO::PARAM_INT);
            $statement->bindParam(":product_quantity", $productData["product_quantity"], PDO::PARAM_INT);
            $statement->bindParam(":product_description", $productData["product_description"], PDO::PARAM_STR);
            $statement->bindParam(":product_detail", $productData["product_detail"], PDO::PARAM_STR);
            $statement->bindParam(":product_featured", $productData["product_featured"], PDO::PARAM_STR);
            $statement->bindParam(":product_promotion", $productData["product_promotion"], PDO::PARAM_STR);
            $statement->bindParam(":category_id", $productData["category_id"], PDO::PARAM_INT);
            return $statement->execute();
        }
        public function updateProduct($productData){
            $query= "UPDATE products SET
                        product_name=:product_name,
                        original_price=:original_price,
                        discount_rate=:discount_rate,
                        discounted_price=:discounted_price,
                        product_quantity=:product_quantity,
                        product_description=:product_description,
                        product_detail=:product_detail,
                        product_featured=:product_featured,
                        product_promotion=:product_promotion,
                        category_id=:category_id
                        WHERE product_id=:product_id";
             $statement=$this->db->prepare($query);
             $statement->bindParam(":product_id", $productData["product_id"], PDO::PARAM_INT);
             $statement->bindParam(":product_name", $productData["product_name"], PDO::PARAM_STR);
             $statement->bindParam(":original_price", $productData["original_price"], PDO::PARAM_INT);
             $statement->bindParam(":discount_rate", $productData["discount_rate"], PDO::PARAM_INT);
             $statement->bindParam(":discounted_price", $productData["discounted_price"], PDO::PARAM_INT);
             $statement->bindParam(":product_quantity", $productData["product_quantity"], PDO::PARAM_INT);
             $statement->bindParam(":product_description", $productData["product_description"], PDO::PARAM_STR);
             $statement->bindParam(":product_detail", $productData["product_detail"], PDO::PARAM_STR);
             $statement->bindParam(":product_featured", $productData["product_featured"], PDO::PARAM_STR);
             $statement->bindParam(":product_promotion", $productData["product_promotion"], PDO::PARAM_STR);
             $statement->bindParam(":category_id", $productData["category_id"], PDO::PARAM_INT);
             return $statement->execute();
        }

        public function updateProductMainPhoto($productId,$mainPhotoId){
            $query= "UPDATE products SET main_photo_id=:main_photo_id WHERE product_id=:product_id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":product_id", $productId, PDO::PARAM_INT);
            $statement->bindParam(":main_photo_id", $mainPhotoId, PDO::PARAM_INT);
            return $statement->execute();
        }

        
        public function deleteProduct($productId){
            $query= "DELETE FROM products WHERE product_id=:product_id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":product_id", $productId, PDO::PARAM_INT);
            return $statement->execute();
        }

    }
?>