<?php 
    require_once __DIR__.'/../_classes/bank-account.class.php';
    $bankAccountModel=new BankAccount();
    
    $bankAccounts=$bankAccountModel->getBankAccounts();

    if(isset($_GET['account_id'])){
        $accountId=$_GET['account_id'];
        $bankAccount=$bankAccountModel->getBankAccountById($accountId);
    }

    
?>