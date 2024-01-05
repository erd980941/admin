<?php
require_once __DIR__.'/../_data_access/db-connector.php';

class OurDocument
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }


    public function getAllDocuments()
    {
        $query = "SELECT * FROM our_documents ORDER BY document_id DESC";
        $statement = $this->db->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getDocumentById($documentId)
    {
        $query = "SELECT * FROM our_documents WHERE document_id=:document_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':document_id', $documentId);
        $statement->execute();
        $document = $statement->fetch(PDO::FETCH_ASSOC);
        return $document ? $document : null;

    }
    public function getDocumentPathById($documentId){
        $query = 'SELECT document_path FROM our_documents WHERE document_id=:document_id';
        $statement = $this->db->prepare($query);
        $statement->bindParam(':document_id', $documentId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return isset($result['document_path'])?$result['document_path']:null;
    }
    
    public function addDocument($documentData)
    {
        $query = "INSERT INTO our_documents SET document_path = :document_path, document_title=:document_title";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':document_path', $documentData['document_path']);
        $statement->bindParam(':document_title', $documentData['document_title']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDocument($documentData,$documentId)
    {
        $query = "UPDATE our_documents SET  document_title=:document_title WHERE document_id=:document_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':document_title', $documentData['document_title']);
        $statement->bindParam(':document_id', $documentId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDocumentPath($documentPath,$documentId){
        $query = "UPDATE our_documents SET document_path = :document_path WHERE document_id =:document_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':document_path', $documentPath);
        $statement->bindParam(':document_id', $documentId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDocument($documentId) {
        $query = "DELETE FROM our_documents WHERE document_id = :document_id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':document_id', $documentId);
    
        if ($statement->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    
}
?>