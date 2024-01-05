<?php
require_once __DIR__.'/../_data_access/db-connector.php';

class SocialMedia
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }



    //--------------------- Site Ayarlar ---------------------
    public function updateSocialMedia($socialMediaData)
    {
        

        $query = "UPDATE social_media SET 
                  whatsapp = :whatsapp, 
                  instagram = :instagram, 
                  facebook = :facebook, 
                  hepsiburada = :hepsiburada, 
                  n11 = :n11,
                  sahibinden = :sahibinden
                  WHERE social_media_id = 0";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':whatsapp', $socialMediaData['whatsapp']);
        $statement->bindParam(':instagram', $socialMediaData['instagram']);
        $statement->bindParam(':facebook', $socialMediaData['facebook']);
        $statement->bindParam(':hepsiburada', $socialMediaData['hepsiburada']);
        $statement->bindParam(':n11', $socialMediaData['n11']);
        $statement->bindParam(':sahibinden', $socialMediaData['sahibinden']);

        // Güncelleme işlemini gerçekleştir
        if ($statement->execute()) {
            return true; // Başarılıysa true döndür
        } else {
            return false; // Başarısızsa false döndür
        }
    }
    public function getSocialMedia()
    {
        $query = "SELECT * FROM social_media WHERE social_media_id = 0";
        $statement = $this->db->query($query);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

  
}
?>