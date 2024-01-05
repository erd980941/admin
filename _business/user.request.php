<?php
session_start();
require_once __DIR__.'/../_classes/user.class.php';
require_once __DIR__.'/../_classes/site-settings.class.php';
require_once __DIR__.'/../../magaza/helpers/send-mail.php';
require_once __DIR__.'/../_helpers/reset-password-mail-body.php';

if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
    header('Location: ../pages/login');
    exit;
}

$userModel = new User();
if (isset($_GET['user_id']) && $_GET['active'] == true) {

    $userId = $_GET['user_id'];
    $result = $userModel->updateStatus($userId, 1);

    if ($result) {
        header("Location:../pages/user-list?success=true");
        exit();
    } else {
        header("Location:../pages/user-list?error=true");
        exit();
    }
} else if (isset($_GET["user_id"]) && $_GET["passive"] == true) {

    $userId = $_GET['user_id'];
    $result = $userModel->updateStatus($userId, 0);

    if ($result) {
        header("Location:../pages/user-list?success=true");
        exit();
    } else {
        header("Location:../pages/user-list?error=true");
        exit();
    }
} else if (isset($_GET['user_id']) && $_GET['delete'] == true) {
    $userId = htmlspecialchars($_GET['user_id']);
    $result = $userModel->deleteUser($userId);

    if ($result) {
        header("Location:../pages/user-list?success=true");
        exit();
    } else {
        header("Location:../pages/user-list?error=true");
        exit();
    }

} else if (isset($_GET['user_id']) && isset($_GET['user_email']) && $_GET['reset_password'] == true) {
    $userId = htmlspecialchars($_GET['user_id']);
    $userEmail=htmlspecialchars($_GET['user_email']);

    

    function randomPassword($length) {
        $chars = 'abcdefghijklmnopqrstuvwxyz'; // Küçük harfler
        $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Büyük harfler
        $chars .= '0123456789'; // Rakamlar
    
        $password = '';
        $charsLength = strlen($chars);
    
        // Rastgele büyük harf, küçük harf ve rakam seçerek şifre oluşturma
        for ($i = 0; $i < $length-3; $i++) { // Toplam karakter sayısı - (2 büyük harf + 1 küçük harf + 1 rakam)
            $password .= $chars[rand(0, $charsLength - 1)];
        }
    
        // Büyük harf ekleme
        $password .= $chars[rand(26, 51)];
    
        // Küçük harf ekleme
        $password .= $chars[rand(0, 25)];
    
        // Rakam ekleme
        $password .= $chars[rand(52, 61)];
    
        // Şifreyi karıştırma
        $password = str_shuffle($password);
    
        return $password;
    }
    

    $newPassword=randomPassword(10);
    $userNewPasswordData=[
        'user_id'=>$userId,
        'user_email'=>$userEmail,
        'new_password'=>$newPassword
    ];
    
    

    $isresetPassword=$userModel->resetUserPassword($userNewPasswordData);
    
    if($isresetPassword){
        $siteSettingModel=new SiteSettings();
        
        $siteSetting=$siteSettingModel->getAllSettingForEmail();

        

        $mailData = [
            'site_name' => $siteSetting['site_title'],
            'SMTP_Host' => $siteSetting['site_smtpHost'],
            'SMTP_Email' => $siteSetting['site_smtpEmail'],
            'SMTP_Username' => $siteSetting['site_smtpUser'],
            'SMTP_Password' => $siteSetting['site_smtpPassword'],
            'SMTP_Port' => intval($siteSetting['site_smtpPort']),
            'user_email' => $userEmail,
            'mail_subject' => "Şifre Sıfırlama",
            'mail_body' => resetPasswordMailBody($siteSetting, $newPassword)
    
        ];
        $isSent = sendVerificationEmail($mailData);

        if ($isSent) {
            header("Location:../pages/user-list?success=true");
            exit();
        } else {
            header("Location:../pages/user-list?error=true");
            exit();
        }

    }else{
        header("Location:../pages/user-list?error=true");
        exit();
    }

    
}else{
    header("Location:../pages/user-list?error=true");
    exit();
}

?>