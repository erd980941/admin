<?php
class DbConnector
{
    private static $instance;
    private $db;

    private function __construct()
    {
        try {
            //$this->db = new PDO("Data Source Name", 'Username', 'Password');
            //$this->db = new PDO("mysql:host=localhost;dbname=dbname;charset=utf8", 'root', '');
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