<?php
require_once __DIR__.'/../_data_access/db-connector.php';

class OrderShippingInfo
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

   

    public function getAllShippingInfo($orderId){
        $query='SELECT * FROM order_shipping_info WHERE order_id=:order_id LIMIT 2';
        $statement=$this->db->prepare($query);
        $statement->bindParam(':order_id',$orderId,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    
    

}
?>