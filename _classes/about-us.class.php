<?php 
require_once '../_data_access/db-connector.php';

class AboutUs{
    private $db;
    public function __construct()
    {
        $dbConnector=DbConnector::getInstance();
        $this->db=$dbConnector->getConnection();
    }

    public function updateAboutUs($aboutUsData)
    {
        $aboutUsTitle=$aboutUsData['about_title'];
        $aboutUsContent=$aboutUsData['about_content'];
        $aboutUsImageAlt=$aboutUsData['about_image_alt'];

        $query="UPDATE about_us SET
                about_title=:about_title,
                about_content=:about_content,
                about_image_alt=:about_image_alt
                WHERE about_id=0";

        $statement=$this->db->prepare($query);
        $statement->bindParam(':about_title',$aboutUsTitle);
        $statement->bindParam(':about_content',$aboutUsContent);
        $statement->bindParam(':about_image_alt',$aboutUsImageAlt);

        if ($statement->execute()) {
            return true;
        }
        else{
            return false;
        }
        
    }

    public function getAboutUs(){
        $query= "SELECT * FROM about_us WHERE about_id=0";
        $statement=$this->db->query($query);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAboutUsImage(){
        $query = "SELECT about_image FROM about_us WHERE about_id = 0";
        $statement = $this->db->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['about_image'];
    }

    public function updateAboutUsImage($siteLogoPath){
        $query = "UPDATE about_us SET about_image = :about_image WHERE about_id = 0";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':about_image', $siteLogoPath);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
?>