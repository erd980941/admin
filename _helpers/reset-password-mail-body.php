<?php function resetPasswordMailBody($bodyData,$newPassword){

$body = '
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hesap Aktivasyonu</title>
    <style>
        .mail-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; 
            color: #fff !important; 
            text-decoration: none;
            margin-top: 20px; 
        }
        .mail-hr {
            margin-top: 20px;
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <p>Şifreniz Sıfırlanmıştır.</p>
    
    <p>Yeni Şifreniz : '.$newPassword.' <b></b></p>
    <span>Yeni şifrenizi kimseyle paylaşmayın. Oluşturulan bu şifreyi hesabınıza giriş yaptıktan sonra değiştirmenizi öneririz.</span>
    
    <hr class="mail-hr">
    <b>'.$bodyData['site_title'].'</b><br>
    <address>'.$bodyData['site_address']."<br>".$bodyData['site_district']." / ".$bodyData['site_city'].'</address><br>
    <b>Web: </b><a href="'.$bodyData['site_url'].'">'.$bodyData['site_url'].'</a><br>
    <b>Tel: </b>'.$bodyData['site_tel'].'
</body>
</html>
';

// Oluşturulan içeriği geri döndür
return $body;
}

?>