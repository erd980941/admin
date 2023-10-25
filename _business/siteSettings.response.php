<?php
require_once '../_classes/siteSettings.class.php';
$siteSettingsModel = new SiteSettings();

//-----------------Smtp Email Ayarları------------------
$siteSettingsEmail = $siteSettingsModel->getSiteEmail();
$siteSettingsEmailData = array(
    'site_smtpEmail' => htmlspecialchars($siteSettingsEmail['site_smtpEmail']),
    'site_smtpHost' => htmlspecialchars($siteSettingsEmail['site_smtpHost']),
    'site_smtpPort' => htmlspecialchars($siteSettingsEmail['site_smtpPort']),
    'site_smtpUser' => htmlspecialchars($siteSettingsEmail['site_smtpUser']),
    'site_smtpPassword' => htmlspecialchars($siteSettingsEmail['site_smtpPassword'])
);

//-----------------Site Ayarları------------------
$siteSettings = $siteSettingsModel->getSiteSettings();
$siteSettingsData = array(
    'site_title' => htmlspecialchars($siteSettings['site_title']),
    'site_description' => htmlspecialchars($siteSettings['site_description']),
    'site_keywords' => htmlspecialchars($siteSettings['site_keywords']),
    'site_author' => htmlspecialchars($siteSettings['site_author']),
    'site_zopim' => htmlspecialchars($siteSettings['site_zopim']),
    'site_maps' => htmlspecialchars($siteSettings['site_maps'])
);

//-----------------İletişim Ayarları------------------
$siteContactInformationData = $siteSettingsModel->getSiteContactInformation();
$siteContactInformationData = array(
    'site_city' => htmlspecialchars($siteContactInformationData['site_city']),
    'site_district' => htmlspecialchars($siteContactInformationData['site_district']),
    'site_address' => htmlspecialchars($siteContactInformationData['site_address']),
    'site_tel' => htmlspecialchars($siteContactInformationData['site_tel'])
);

//-----------------LOGO------------------
$siteLogoPath = htmlspecialchars($siteSettingsModel->getSiteLogo());
if (empty($siteLogoPath)) {
    $siteLogoPath = '../../assets/img/no-image.jpg';
} else {
    $siteLogoPath = htmlspecialchars($siteLogoPath);
}

?>