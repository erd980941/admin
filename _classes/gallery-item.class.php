<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class GalleryItem{
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }

        public function getGalleryItems(){
            $query='SELECT * FROM gallery_items ORDER BY created_at DESC';
            $statement= $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getGalleryItemById($itemId){
            $query= 'SELECT * FROM gallery_items WHERE item_id=:item_id LIMIT 1';
            $statement= $this->db->prepare($query);
            $statement->bindParam(':item_id', $itemId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function getGalleryPathById($itemId){
            $query= 'SELECT image_path FROM gallery_items WHERE item_id=:item_id LIMIT 1';
            $statement= $this->db->prepare($query);
            $statement->bindParam(':item_id', $itemId, PDO::PARAM_INT);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);
            return isset($result['image_path'])?$result['image_path']:null;
        }



        public function addGalleryItem($sliderData){
            $query= 'INSERT INTO gallery_items SET image_path=:image_path';
                            
            $statement=$this->db->prepare($query);
            $statement->bindParam(':image_path', $sliderData['image_path'], PDO::PARAM_STR);

            return $statement->execute();
        }
        

       

        public function deleteGalleryItem($itemId){
            $query= 'DELETE FROM gallery_items WHERE item_id=:item_id';
            $statement=$this->db->prepare($query);
            $statement->bindParam(':item_id', $itemId, PDO::PARAM_INT);
            return $statement->execute();
        }

    }
?>