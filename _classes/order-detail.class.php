<?php
require_once __DIR__.'/../_data_access/db-connector.php'; // Veritabanı bağlantısını sağlayan dosya

class OrderDetail
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function getOrderDetailsByOrderId($orderId){
        $query='SELECT od.*,p.product_name,p.original_price,p.discount_rate,p.discounted_price,p.product_quantity,pp.photo_name
                FROM order_details od 
                INNER JOIN products p ON od.product_id=p.product_id
                LEFT JOIN product_photos pp ON pp.photo_id=p.main_photo_id
                WHERE od.order_id=:order_id';

        $statement=$this->db->prepare($query);
        $statement->bindParam(':order_id',$orderId,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>