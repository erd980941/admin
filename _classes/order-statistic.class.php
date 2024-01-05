<?php
require_once __DIR__.'/../_data_access/db-connector.php'; // Veritabanı bağlantısını sağlayan dosya

class OrderStatistic
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function getTotalOrderAmountThisYear($orderStatus, $year){
        $query = "SELECT SUM(total_amount) as total,COUNT(*) as order_count FROM orders 
                  WHERE YEAR(order_date) = :year
                  AND payment_status = '1'
                  AND order_status = :order_status";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':year', $year, PDO::PARAM_INT);
        $statement->bindParam(':order_status', $orderStatus, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }
    public function getOrderCountByMonthThisYear($orderStatus, $year){
        $query = "SELECT COUNT(*) as order_count, MONTH(order_date) as order_month 
                  FROM orders 
                  WHERE YEAR(order_date) = :year
                  AND MONTH(order_date) BETWEEN 1 AND 12
                  AND payment_status = '1'
                  AND order_status = :order_status
                  GROUP BY MONTH(order_date)";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':year', $year, PDO::PARAM_INT);
        $statement->bindParam(':order_status', $orderStatus, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    
    public function getTopFiveSoldProductsThisYear($year) {
        $query = "SELECT p.product_id, p.product_name, SUM(od.quantity) AS total_quantity
                  FROM order_details od
                  INNER JOIN products p ON od.product_id = p.product_id
                  WHERE YEAR(od.created_at) = :year
                  GROUP BY od.product_id
                  ORDER BY total_quantity DESC
                  LIMIT 5";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':year', $year, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function getOrderCountByStatus($orderStatus, $year) {
        $query = "SELECT COUNT(*) as order_count 
                  FROM orders 
                  WHERE YEAR(order_date) = :year
                  AND payment_status = '1'
                  AND order_status = :order_status";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':year', $year, PDO::PARAM_INT);
        $statement->bindParam(':order_status', $orderStatus, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $result['order_count'];
    }

    public function getOrderCountByNotPaymentStatus($year) {
        $query = "SELECT COUNT(*) as order_count 
                  FROM orders 
                  WHERE YEAR(order_date) = :year
                  AND payment_status ='0'";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':year', $year, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $result['order_count'];
    }

}
?>