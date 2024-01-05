<?php 
// get_user_addresses.php içinde
require_once __DIR__.'/../_classes/user-contact.class.php';
$userContactModel = new UserContact();

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $userAddresses = $userContactModel->getContactByUserId($userId);

    
}

?>