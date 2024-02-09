<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class WhyUs  {
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }
        public function getWhyUsItems(){
            $query = "SELECT * FROM why_us ORDER BY why_us_id DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getWhyUsItemById($whyUsId){
            $query = "SELECT * FROM why_us WHERE why_us_id=:why_us_id LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":why_us_id", $whyUsId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    
        public function addWhyUsItem($whyUsData){
            $query="INSERT INTO why_us SET 
                        why_us_title=:why_us_title,
                        why_us_content=:why_us_content";
            $statement=$this->db->prepare($query);
            $statement->bindParam(":why_us_title", $whyUsData["why_us_title"], PDO::PARAM_STR);
            $statement->bindParam(":why_us_content", $whyUsData["why_us_content"], PDO::PARAM_STR);
            return $statement->execute();
        }
    
        public function updateWhyUsItem($whyUsData){
            $query= "UPDATE why_us SET
                        why_us_title=:why_us_title,
                        why_us_content=:why_us_content
                        WHERE why_us_id=:why_us_id";
             $statement=$this->db->prepare($query);
             $statement->bindParam(":why_us_id", $whyUsData["why_us_id"], PDO::PARAM_INT);
             $statement->bindParam(":why_us_title", $whyUsData["why_us_title"], PDO::PARAM_STR);
             $statement->bindParam(":why_us_content", $whyUsData["why_us_content"], PDO::PARAM_STR);
             return $statement->execute();
        }
    
        public function deleteWhyUsItem($whyUsId){
            $query= "DELETE FROM why_us WHERE why_us_id=:why_us_id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":why_us_id", $whyUsId, PDO::PARAM_INT);
            return $statement->execute();
        }
    }
?>