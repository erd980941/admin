<?php 
    require_once __DIR__.'/../_classes/user.class.php';

    $userModel=new User();
    $users=$userModel->getUsers();
?>