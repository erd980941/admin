<?php
class DbConnector
{
    private static $instance;
    private $db;

    private function __construct()
    {
        try {
            $dbConfig = include(__DIR__ . "/../config/db.php");
            
            $this->db = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset=utf8", $dbConfig['username'], $dbConfig['password']);  
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            throw new Exception("Veritabanı bağlantısı başarısız: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->db;
    }
}

?>