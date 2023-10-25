<?php
require_once '../_data_access/dbConnector.php';

class Authenticate
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    //-----------------Site Ayarları------------------
    public function checkAdminCredentials($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM site_admin WHERE admin_id = 0 LIMIT 1");
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            if ($admin['admin_username'] == $username) {
                if (password_verify($password, $admin['admin_password'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }





}
?>