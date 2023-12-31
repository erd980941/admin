<?php
require_once '../_data_access/db-connector.php';

class SiteSettings
{
    private $db;

    public function __construct()
    {
        $dbConnector = DbConnector::getInstance();
        $this->db = $dbConnector->getConnection();
    }



    //--------------------- Site Ayarlar ---------------------
    public function updateSiteSettings($siteSettingsData)
    {
        $siteTitle = $siteSettingsData['site_title'];
        $siteDescription = $siteSettingsData['site_description'];
        $siteKeywords = $siteSettingsData['site_keywords'];
        $siteAuthor = $siteSettingsData['site_author'];
        $siteZopim = $siteSettingsData['site_zopim'];
        $siteMaps = $siteSettingsData['site_maps'];

        $query = "UPDATE site_settings SET 
                  site_title = :site_title, 
                  site_description = :site_description, 
                  site_keywords = :site_keywords, 
                  site_author = :site_author, 
                  site_zopim = :site_zopim,
                  site_maps = :site_maps 
                  WHERE site_id = 0";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':site_title', $siteTitle);
        $statement->bindParam(':site_description', $siteDescription);
        $statement->bindParam(':site_keywords', $siteKeywords);
        $statement->bindParam(':site_author', $siteAuthor);
        $statement->bindParam(':site_zopim', $siteZopim);
        $statement->bindParam(':site_maps', $siteMaps);

        // Güncelleme işlemini gerçekleştir
        if ($statement->execute()) {
            return true; // Başarılıysa true döndür
        } else {
            return false; // Başarısızsa false döndür
        }
    }
    public function getSiteSettings()
    {
        $query = "SELECT * FROM site_settings WHERE site_id = 0";
        $statement = $this->db->query($query);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    //--------------------- Site İletişim Ayarları  ---------------------
    public function updateContactInformation($contactInformationData)
    {
        $siteCity = $contactInformationData['site_city'];
        $siteDistrict = $contactInformationData['site_district'];
        $siteAddress = $contactInformationData['site_address'];
        $siteTel = $contactInformationData['site_tel'];

        $query = "UPDATE site_contact_information SET 
                  site_city = :site_city, 
                  site_district = :site_district, 
                  site_address = :site_address, 
                  site_tel = :site_tel 
                  WHERE site_id = 0";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':site_city', $siteCity);
        $statement->bindParam(':site_district', $siteDistrict);
        $statement->bindParam(':site_address', $siteAddress);
        $statement->bindParam(':site_tel', $siteTel);

        // Güncelleme işlemini gerçekleştir
        if ($statement->execute()) {
            return true; // Başarılıysa true döndür
        } else {
            return false; // Başarısızsa false döndür
        }
    }
    public function getSiteContactInformation()
    {
        $query = "SELECT * FROM site_contact_information WHERE site_id = 0";
        $statement = $this->db->query($query);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    //--------------------- Site Email ---------------------
    public function updateSiteEmail($siteEmailData)
    {
        $siteSmtpEmail = $siteEmailData['site_smtpEmail'];
        $siteSmtpHost = $siteEmailData['site_smtpHost'];
        $siteSmtpPort = $siteEmailData['site_smtpPort'];
        $siteSmtpUser = $siteEmailData['site_smtpUser'];
        $siteSmtpPassword = $siteEmailData['site_smtpPassword'];

        $query = "UPDATE site_email SET 
                  site_smtpEmail = :siteSmtpEmail, 
                  site_smtpHost = :siteSmtpHost, 
                  site_smtpPort = :siteSmtpPort, 
                  site_smtpUser = :siteSmtpUser, 
                  site_smtpPassword = :siteSmtpPassword 
                  WHERE site_id = 0";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':siteSmtpEmail', $siteSmtpEmail);
        $statement->bindParam(':siteSmtpHost', $siteSmtpHost);
        $statement->bindParam(':siteSmtpPort', $siteSmtpPort);
        $statement->bindParam(':siteSmtpUser', $siteSmtpUser);
        $statement->bindParam(':siteSmtpPassword', $siteSmtpPassword);

        // Güncelleme işlemini gerçekleştir
        if ($statement->execute()) {
            return true; // Başarılıysa true döndür
        } else {
            return false; // Başarısızsa false döndür
        }
    }
    public function getSiteEmail()
    {
        $query = "SELECT * FROM site_email WHERE site_id = 0";
        $statement = $this->db->query($query);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    //--------------------- LOGO ---------------------
    public function getSiteLogo()
    {
        $query = "SELECT site_logo FROM site_settings WHERE site_id = 0";
        $statement = $this->db->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['site_logo'];
    }
    public function updateSiteLogo($siteLogoPath)
    {
        $query = "UPDATE site_settings SET site_logo = :site_logo WHERE site_id = 0";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':site_logo', $siteLogoPath);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>