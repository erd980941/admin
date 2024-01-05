<?php
require_once __DIR__.'/../_data_access/db-connector.php';

class MisionVision
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function updateMisionVision($misionVisionData)
    {

        $query = "UPDATE mision_vision SET
                mv_title=:mv_title,
                mv_content=:mv_content
                WHERE mv_type=:mv_type LIMIT 1";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':mv_title', $misionVisionData['mv_title']);
        $statement->bindParam(':mv_content', $misionVisionData['mv_content']);
        $statement->bindParam(':mv_type', $misionVisionData['mv_type']);

        return $statement->execute();

    }

    public function getMisionVision($mv_type)
    {
        $query = "SELECT * FROM mision_vision WHERE mv_type=:mv_type LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':mv_type', $mv_type);
        $statement->execute(); 

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getMisionVisionImage($mv_type)
    {
        $query = "SELECT mv_image FROM mision_vision WHERE mv_type=:mv_type LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':mv_type', $mv_type);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['mv_image'];
    }

    public function updateMisionVisionImage($misionVisionImage, $mv_type)
    {
        $query = "UPDATE mision_vision SET mv_image = :mv_image WHERE mv_type=:mv_type LIMIT 1";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':mv_image', $misionVisionImage);
        $statement->bindParam(':mv_type', $mv_type);

        return $statement->execute();
    }
}
?>