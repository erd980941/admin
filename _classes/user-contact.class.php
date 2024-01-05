<?php 
require_once __DIR__.'/../_data_access/db-connector.php';

class UserContact{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }

    public function getContactByUserId($userId){
        $query = 'SELECT * FROM user_contact WHERE user_id=:user_id ORDER BY contact_id DESC';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteContact($contactId){
        $query = 'DELETE FROM user_contact WHERE contact_id=:contact_id';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':contact_id', $contactId, PDO::PARAM_INT);
        return $statement->execute();
    }

    

}
?>