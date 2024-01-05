<?php
require_once __DIR__.'/../_data_access/db-connector.php'; // Veritabanı bağlantısını sağlayan dosya

class Order
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function getOrders(){
        $query='SELECT o.*,u.user_email,u.user_first_name,u.user_last_name ,u.user_phone_number,u.user_status
                FROM orders o
                INNER JOIN users u ON o.user_id=u.user_id
                ORDER BY order_date DESC';

        $statement=$this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrdersByStatus($orderStatus){
        $query='SELECT o.*,u.user_email,u.user_first_name,u.user_last_name ,u.user_phone_number,u.user_status
                FROM orders o
                INNER JOIN users u ON o.user_id=u.user_id
                WHERE o.order_status=:order_status
                ORDER BY order_date DESC';

        $statement=$this->db->prepare($query);
        $statement->bindParam(':order_status',$orderStatus,PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function getEnumValuesForOrderStatus(){
        $query = "SHOW COLUMNS FROM orders WHERE Field = 'order_status'";
        $result = $this->db->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $enumList = explode("','", substr($row['Type'], 6, -2));
        return $enumList;
    }

    public function updateOrderStatus($orderId, $orderStatus){
        $query = 'UPDATE orders SET order_status = :order_status WHERE order_id = :orderId';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':order_status', $orderStatus);
        $statement->bindParam(':orderId', $orderId);
        
        return $statement->execute();
    }

    public function updateTrackingNumber($orderId,$trackingNumber){
        $query = 'UPDATE orders SET shipping_tracking_number = :shipping_tracking_number WHERE order_id = :orderId';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':shipping_tracking_number', $trackingNumber);
        $statement->bindParam(':orderId', $orderId);
        
        return $statement->execute();
    }

    public function deleteOrder($orderId){
        $query = 'DELETE FROM orders WHERE order_id = :orderId';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':orderId', $orderId);
        
        return $statement->execute();
    }


}
?>