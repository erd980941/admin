<?php 
    require_once __DIR__.'/../_data_access/db-connector.php';

    class BankAccount {
        private $db;

        public function __construct(){
            $dbConnector=DbConnector::getInstance();
            $this->db=$dbConnector->getConnection();
        }

        public function getBankAccounts(){
            $query = "SELECT * FROM bank_accounts ORDER BY account_id DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getBankAccountById($accountId){
            $query = "SELECT * FROM bank_accounts WHERE account_id=:account_id LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":account_id", $accountId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public function addBankAccount($bankAccountData){
            $query="INSERT INTO bank_accounts SET 
                        bank_name=:bank_name,
                        account_iban=:account_iban,
                        account_name=:account_name,
                        account_branch_code=:account_branch_code,
                        account_number=:account_number,
                        currency_type=:currency_type,
                        account_enabled=:account_enabled";
            $statement=$this->db->prepare($query);
            $statement->bindParam(":bank_name", $bankAccountData["bank_name"], PDO::PARAM_STR);
            $statement->bindParam(":account_iban", $bankAccountData["account_iban"], PDO::PARAM_STR);
            $statement->bindParam(":account_name", $bankAccountData["account_name"], PDO::PARAM_STR);
            $statement->bindParam(":account_branch_code", $bankAccountData["account_branch_code"], PDO::PARAM_INT);
            $statement->bindParam(":account_number", $bankAccountData["account_number"], PDO::PARAM_INT);
            $statement->bindParam(":currency_type", $bankAccountData["currency_type"], PDO::PARAM_STR);
            $statement->bindParam(":account_enabled", $bankAccountData["account_enabled"], PDO::PARAM_STR);
            return $statement->execute();
        }
        public function updateBankAccount($bankAccountData){
            $query= "UPDATE bank_accounts SET
                        bank_name=:bank_name,
                        account_iban=:account_iban,
                        account_name=:account_name,
                        account_branch_code=:account_branch_code,
                        account_number=:account_number,
                        currency_type=:currency_type
                        WHERE account_id=:account_id";
             $statement=$this->db->prepare($query);
             $statement->bindParam(":account_id", $bankAccountData["account_id"], PDO::PARAM_INT);
             $statement->bindParam(":bank_name", $bankAccountData["bank_name"], PDO::PARAM_STR);
             $statement->bindParam(":account_iban", $bankAccountData["account_iban"], PDO::PARAM_STR);
             $statement->bindParam(":account_name", $bankAccountData["account_name"], PDO::PARAM_STR);
             $statement->bindParam(":account_branch_code", $bankAccountData["account_branch_code"], PDO::PARAM_INT);
             $statement->bindParam(":account_number", $bankAccountData["account_number"], PDO::PARAM_INT);
             $statement->bindParam(":currency_type", $bankAccountData["currency_type"], PDO::PARAM_STR);
             return $statement->execute();
        }

        public function updateBankAccountEnable($bankAccountData){

            $query="UPDATE bank_accounts SET account_enabled =:account_enabled WHERE account_id=:account_id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":account_id", $bankAccountData['account_id'], PDO::PARAM_INT);
            $statement->bindParam(":account_enabled", $bankAccountData['account_enabled'], PDO::PARAM_STR);
            return $statement->execute();
        }
        
        public function deleteBankAccount($accountId){
            $query= "DELETE FROM bank_accounts WHERE account_id=:account_id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":account_id", $accountId, PDO::PARAM_INT);
            return $statement->execute();
        }

    }
?>