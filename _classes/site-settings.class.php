<?php
require_once __DIR__.'/../_data_access/db-connector.php';

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
        $siteUrl = $siteSettingsData['site_url'];

        $query = "UPDATE site_settings SET 
                  site_title = :site_title, 
                  site_description = :site_description, 
                  site_keywords = :site_keywords, 
                  site_author = :site_author, 
                  site_zopim = :site_zopim,
                  site_url = :site_url
                  WHERE site_id = 0";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':site_title', $siteTitle);
        $statement->bindParam(':site_description', $siteDescription);
        $statement->bindParam(':site_keywords', $siteKeywords);
        $statement->bindParam(':site_author', $siteAuthor);
        $statement->bindParam(':site_zopim', $siteZopim);
        $statement->bindParam(':site_url', $siteUrl);

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
        $siteContactText = $contactInformationData['site_contact_text'];
        $siteCity = $contactInformationData['site_city'];
        $siteDistrict = $contactInformationData['site_district'];
        $siteAddress = $contactInformationData['site_address'];
        $siteMaps = $contactInformationData['site_maps'];
        $siteTel = $contactInformationData['site_tel'];
        $siteWhatsapp = $contactInformationData['site_whatsapp'];
        $siteEmail = $contactInformationData['site_email'];

        $query = "UPDATE site_contact_information SET 
                  site_contact_text = :site_contact_text, 
                  site_city = :site_city, 
                  site_district = :site_district, 
                  site_address = :site_address, 
                  site_maps = :site_maps, 
                  site_tel = :site_tel,
                  site_whatsapp = :site_whatsapp,
                  site_email = :site_email 
                  WHERE site_id = 0";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':site_contact_text', $siteContactText);
        $statement->bindParam(':site_city', $siteCity);
        $statement->bindParam(':site_district', $siteDistrict);
        $statement->bindParam(':site_address', $siteAddress);
        $statement->bindParam(':site_maps', $siteMaps);
        $statement->bindParam(':site_tel', $siteTel);
        $statement->bindParam(':site_whatsapp', $siteWhatsapp);
        $statement->bindParam(':site_email', $siteEmail);

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

    public function getAllSettingForEmail(){
        $query='SELECT
        ss.site_id,ss.site_title,ss.site_url,
        sci.site_city,sci.site_district,sci.site_address,sci.site_tel,
        se.site_smtpEmail,se.site_smtpHost,se.site_smtpUser,se.site_smtpPassword,se.site_smtpPort
        FROM site_settings ss
        INNER JOIN site_email se ON ss.site_id=se.site_id
        INNER JOIN site_contact_information sci ON ss.site_id=sci.site_id
        WHERE ss.site_id=0';
        $statement = $this->db->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
   
}
?>