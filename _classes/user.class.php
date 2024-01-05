<?php
require_once __DIR__.'/../_data_access/db-connector.php';

class User
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function getUsers()
    {
        $query = 'SELECT user_id, user_email, user_first_name, user_last_name, email_verified, user_status FROM users ORDER BY user_id DESC';
        $statement = $this->db->query($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
    }

    public function updateStatus($userId, $status)
    {
        $query = 'UPDATE users SET user_status=:user_status WHERE user_id=:user_id';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':user_status', $status, PDO::PARAM_STR);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $statement->execute();
    }
    public function deleteUser($userId)
    {
        $query = 'DELETE FROM users WHERE user_id=:user_id';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function resetUserPassword($userData)
    {

        $hashedNewPassword = password_hash($userData['new_password'], PASSWORD_DEFAULT);

        $query = 'UPDATE users SET user_password=:user_password WHERE user_id=:user_id AND user_email=:user_email';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':user_id', $userData['user_id'], PDO::PARAM_INT);
        $statement->bindParam(':user_email', $userData['user_email'], PDO::PARAM_STR);
        $statement->bindParam(':user_password', $hashedNewPassword, PDO::PARAM_STR);
        $result = $statement->execute();

        if ($result) {
            $affectedRows = $statement->rowCount();
            return $affectedRows > 0; // Etkilenen satır sayısı 0'dan büyükse true döndür
        } else {
            // Hata durumunu ele almak için gerekli işlemler
            return false;
        }

    }

}
?>