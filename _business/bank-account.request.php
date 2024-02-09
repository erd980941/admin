<?php 
    session_start();
    require_once __DIR__.'/../_classes/bank-account.class.php';
    $bankAccountModel=new BankAccount();
    
    if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
        header('Location: ../pages/login');
        exit;
    }

    if (isset($_POST['add_bank_account'])) {
        $bankAccountData=array(
            'bank_name'=> $_POST['bank_name'],
            'account_iban'=> $_POST['account_iban'],
            'account_name'=> $_POST['account_name'],
            'account_branch_code'=> $_POST['account_branch_code'],
            'account_number'=> $_POST['account_number'],
            'currency_type'=> $_POST['currency_type'],
            'account_enabled'=> $_POST['account_enabled'],
        );


        $result=$bankAccountModel->addBankAccount($bankAccountData);
        
        if ($result) {
            header("Location:../pages/bank-account-list?success=true");
            exit();
        } else {
            header("Location:../pages/bank-account-list?error=true");
            exit();
        }
    }

    if (isset($_POST['edit_bank_account'])) {
        $bankAccountData=array(
            'bank_name'=> $_POST['bank_name'],
            'account_iban'=> $_POST['account_iban'],
            'account_name'=> $_POST['account_name'],
            'account_branch_code'=> $_POST['account_branch_code'],
            'account_number'=> $_POST['account_number'],
            'currency_type'=> $_POST['currency_type'],
            'account_id'=> $_POST['account_id'],
        );

        $result=$bankAccountModel->updateBankAccount($bankAccountData);
        
        if ($result) {
            header("Location:../pages/bank-account-list?success=true");
            exit();
        } else {
            header("Location:../pages/bank-account-list?error=true");
            exit();
        }
    }

    if (isset($_GET['account_id'])&&$_GET['delete']=='true') {
        $accountId=$_GET['account_id'];
        $result =$bankAccountModel->deleteBankAccount($accountId);
        if ($result) {
            header("Location:../pages/bank-account-list?success=true");
            exit();
        } else {
            header("Location:../pages/bank-account-list?error=true");
            exit();
        }
    }

    if(isset($_GET["account_id"])&&isset($_GET["account_enabled"])){

        $accountData=[
            'account_id'=>htmlspecialchars($_GET['account_id']),
            'account_enabled'=>htmlspecialchars($_GET['account_enabled'])
        ];

        $result=$bankAccountModel->updateBankAccountEnable($accountData);
        if ($result) {
            header("Location:../pages/bank-account-list?success=true");
            exit();
        } else {
            header("Location:../pages/bank-account-list?error=true");
            exit();
        }
    }

    if(isset($_GET["account_id"])&&$_GET["delete"]== "true"){
        $accountId=$_GET['account_id'];

        $result=$bankAccountModel->deleteBankAccount($accountId);
        if ($result) {
            header("Location:../pages/bank-account-list?success=true");
            exit();
        } else {
            header("Location:../pages/bank-account-list?error=true");
            exit();
        }
    }

    
?>