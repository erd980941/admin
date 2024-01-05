<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class SliderItem{
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }

        public function getSliderItems(){
            $query='SELECT * FROM slider_items ORDER BY slider_id DESC';
            $statement= $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getSliderItemById($sliderId){
            $query= 'SELECT * FROM slider_items WHERE slider_id=:slider_id LIMIT 1';
            $statement= $this->db->prepare($query);
            $statement->bindParam(':slider_id', $sliderId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function getSliderPathById($sliderId){
            $query= 'SELECT slider_path FROM slider_items WHERE slider_id=:slider_id LIMIT 1';
            $statement= $this->db->prepare($query);
            $statement->bindParam(':slider_id', $sliderId, PDO::PARAM_INT);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);
            return isset($result['slider_path'])?$result['slider_path']:null;
        }

        public function getSliderOrderPriority($sliderId){
            $query='SELECT order_priority FROM slider_items WHERE slider_id=:slider_id';
            $statement= $this->db->prepare($query);
            $statement->bindParam(':slider_id', $sliderId, PDO::PARAM_INT);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);
            return isset($result['order_priority']) ? $result['order_priority'] : -1;
        }

        public function getMaxOrderPriority(){
            $query = 'SELECT MAX(order_priority) AS max_priority FROM slider_items';
            $statement = $this->db->prepare($query);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return isset($result['max_priority']) ? (int)$result['max_priority'] : 0;
        }

        public function checkOrderPriorityExists($orderPriority) {
            $query = 'SELECT COUNT(*) AS count FROM slider_items WHERE order_priority = :order_priority';
            $statement = $this->db->prepare($query);
            $statement->bindParam(':order_priority', $orderPriority, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        
            return ($result['count'] > 0) ? true : false;
        }

        public function addSliderItem($sliderData){
            $query= 'INSERT INTO slider_items SET
                            slider_title=:slider_title,   
                            slider_path=:slider_path,    
                            slider_type=:slider_type,    
                            order_priority=:order_priority';
                            
            $statement=$this->db->prepare($query);
            $statement->bindParam(':slider_title', $sliderData['slider_title'], PDO::PARAM_STR);
            $statement->bindParam(':slider_path', $sliderData['slider_path'], PDO::PARAM_STR);
            $statement->bindParam(':slider_type', $sliderData['slider_type'], PDO::PARAM_STR);
            $statement->bindParam(':order_priority', $sliderData['order_priority'], PDO::PARAM_INT);

            return $statement->execute();
        }
        

        public function updateSliderItem($sliderData) {
            $query = 'UPDATE slider_items SET
                        slider_title = :slider_title,
                        order_priority = :order_priority
                        WHERE slider_id = :slider_id';
            $statement = $this->db->prepare($query);
            $statement->bindParam(':slider_title', $sliderData['slider_title'], PDO::PARAM_STR);
            $statement->bindParam(':slider_id', $sliderData['slider_id'], PDO::PARAM_INT);
            $statement->bindParam(':order_priority', $sliderData['order_priority'], PDO::PARAM_INT);
        
            return $statement->execute();
        }

        public function updateSliderPath($sliderPathData,$sliderId){
            $query = "UPDATE slider_items SET slider_path = :slider_path, slider_type=:slider_type WHERE slider_id =:slider_id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':slider_path', $sliderPathData['slider_path'],PDO::PARAM_STR);
            $statement->bindParam(':slider_type', $sliderPathData['slider_type'],PDO::PARAM_STR);
            $statement->bindParam(':slider_id', $sliderId);
    
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

       

        public function updateSliderOrderPriority($orderPriority,$sliderId){
            if ($orderPriority>100 || $orderPriority<0) return false;
            $query = 'UPDATE slider_items SET order_priority=:order_priority WHERE slider_id=:slider_id';
            $statement = $this->db->prepare($query);
            $statement->bindParam(':order_priority', $orderPriority, PDO::PARAM_INT);
            $statement->bindParam(':slider_id', $sliderId, PDO::PARAM_INT);
            return  $statement->execute();
        }

        public function deleteSliderItem($sliderId){
            $query= 'DELETE FROM slider_items WHERE slider_id=:slider_id';
            $statement=$this->db->prepare($query);
            $statement->bindParam(':slider_id', $sliderId, PDO::PARAM_INT);
            return $statement->execute();
        }

    }
?>