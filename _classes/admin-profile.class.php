<?php
require_once '../_data_access/dbConnector.php';

class AdminProfile
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }



    public function changeAdminPassword($currentPassword, $newPassword)
    {
        if ($this->adminPasswordVerify($currentPassword)) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);


            $stmt = $this->db->prepare("UPDATE site_admin SET admin_password = :newPassword WHERE admin_id = 0");
            $stmt->bindParam(':newPassword', $hashedNewPassword);
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } else {
            return false;
        }
    }

    private function adminPasswordVerify($password)
    {
        $stmt = $this->db->prepare("SELECT * FROM site_admin WHERE admin_id = 0 LIMIT 1");
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($admin) {
            if (password_verify($password, $admin['admin_password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function changeAdminUsername($adminUsername)
    {


        $stmt = $this->db->prepare("UPDATE site_admin SET admin_username = :newUsername WHERE admin_id = 0");
        $stmt->bindParam(':newUsername', $adminUsername);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }









}
?>