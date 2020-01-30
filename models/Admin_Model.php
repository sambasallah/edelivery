<?php declare(strict_types=1);

namespace edelivery\models;

class Admin_Model {

    private $conn;
    private $NUMBER_OF_RECORDS_PER_PAGE = 9;
    private $total_pages = 0;
    public function __construct($database) 
    {
        $this->conn = $database;
    }  
    
    /**
     * @param $data - array
     */
    public function loginAdmin(array $data) : void {
        \extract($data);

        $response = $this->checkLoginDetails($usernameOREmail,$password);

        if($response) {
            $_SESSION['admin_logged_in'] = TRUE;
            $_SESSION['admin'] = $usernameOREmail;
            \header("location:dashboard");
        }else{
            $_SESSION['invalid_credentials'] = 
            "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Invalid Credentials
            </div>";
            \header("location:login");   
        }
    }

     /**
     * @param emailORusername - string
     * @param password - string
     * @return bool
     * 
     * - Verifies login credentials
     * 
     */
    private function checkLoginDetails(string $emailORUsername, string $password) : bool {
        if(filter_var($emailORUsername, FILTER_VALIDATE_EMAIL)) {
            $this->conn->prepareQuery("SELECT * FROM admin WHERE email = :email");
             $this->conn->bind(":email",$emailORUsername);
             $this->conn->executeQuery();
             if($this->conn->rows() == 1) {
                $result = $this->conn->getResult();
                }else {
                    return false;
                }
        }else {
            $this->conn->prepareQuery("SELECT * FROM admin WHERE username = :username");
            $this->conn->bind(":username",$emailORUsername);
            $this->conn->executeQuery();
            if($this->conn->rows() == 1) {
                $result = $this->conn->getResult();
            }else {
                return false;
            }
        }   

        if(\password_verify($password,$result->password)) {
            return true;
        }
        return false; 
    }
    
    /**
     * @return string
     */
    public function getTotalRevenue() : string {
        $this->conn->prepareQuery("SELECT *,SUM(delivery_rates.rate) as total_revenue FROM delivery_requests INNER JOIN delivery_rates ON delivery_rates.rate_id = delivery_requests.rate_id");
        $this->conn->executeQuery();
        $result = $this->conn->getResult();
       if(!empty($result->total_revenue)) {
            return strval($result->total_revenue);
       }

       return "0.00";
    }

    /**
     * @param $page_no - int
     * @return array
     */
    public function getAllPartners(int $page_no) : array {
        $total_rows = $this->getTotalPartnerRows();
        $offset = ($page_no - 1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM partner LIMIT :offset, :number_of_records");
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);

        return $this->conn->getResults();
    }


      /**
     * @param $page_no - int
     * @return array
     */
    public function getAllMerchants(int $page_no) : array {
        $total_rows = $this->getTotalMerchantRows();
        $offset = ($page_no - 1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM merchant LIMIT :offset, :number_of_records");
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);

        return $this->conn->getResults();
    }

      /**
     * @param $page_no - int
     * @return array
     */
    public function getAllDeliveries(int $page_no) : array {
        $total_rows = $this->getTotalDeliveryRows();
        $offset = ($page_no - 1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM delivery_requests LIMIT :offset, :number_of_records");
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);

        return $this->conn->getResults();
    }

    /**
     * @param $user_id - int
     */
    public function deleteMerchant(int $user_id) : void {
       if($this->deleteMerchantDeliveryRequests($user_id)) {
        $this->conn->prepareQuery("DELETE FROM merchant WHERE merchant_id = :id");
        $this->conn->bind(":id",$user_id);

        if($this->conn->executeQuery()) {
            $_SESSION['delete_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Deleted Successfully
            </div>";
            \header("location:merchants");
        } else {
            $_SESSION['delete_failed'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Not Deleted
            </div>";
            \header("location:merchant");
        }
       }
    }

    /**
     * @param $user_id - int
     * @return bool
     */
    public function deleteMerchantDeliveryRequests(int $user_id) : bool {
        $this->conn->prepareQuery("DELETE FROM delivery_requests WHERE merchant_id = :id");
        $this->conn->bind(":id",$user_id);

        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }

    /**
     * @param $page_no - int
     * @return array
     */
    public function getAllUsers(int $page_no) : array {
        $total_rows = $this->getTotalUserRows();
        $offset = ($page_no - 1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM admin LIMIT :offset, :number_of_records");
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);

        return $this->conn->getResults();
    }

    /**
     * @param $user_id - int
     * @return object
     */
    public function getUser(int $user_id) : object {
        $this->conn->prepareQuery("SELECT * FROM admin WHERE id = :id");
        $this->conn->bind(":id",$user_id);

        if( $this->conn->executeQuery() && $this->findUserId($user_id)) {
            return $this->conn->getResult();
        }

        return (object) "Error";
        
    }

    /**
     * @param $data - array
     */
    public function addUser(array $data) : void {
        \extract($data);
        if($this->usernameExists($username)) {
            $_SESSION['username_exists'] = 
            "<div class='alert alert-danger'>
                <strong>Username Exists!</strong>
            </div>";
            \header("location:users");
        }elseif($this->emailExists($email)) {
            $_SESSION['email_exists'] = 
            "<div class='alert alert-danger'>
                <strong>Email Exists!</strong> 
            </div>";

            \header("location:users"); 
        }else {
        $this->conn->prepareQuery("INSERT INTO admin
                                                SET
                                                first_name = :first_name,
                                                last_name = :last_name,
                                                email = :email,
                                                password = :password,
                                                username = :username,
                                                role = :role");
        $this->conn->bind(":first_name",$first_name);
        $this->conn->bind(":last_name",$last_name);
        $this->conn->bind(":email",$email);
        $this->conn->bind(":password",$password);
        $this->conn->bind(":username",$username);
        $this->conn->bind(":role","admin");
        }
        if($this->conn->executeQuery()) {
            $_SESSION['user_success'] = 
            "<div class='alert alert-success alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> User Added Successfully 
            </div>";
            \header("location:users");
        } else {
            "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Occurred
            </div>";
            \header("location:users");
        }
    }

    /**
     * @return array
     */
    public function getAllComplaints(int $page_no) : array {
        $total_rows = $this->getTotalDeliveryRows();
        $offset = ($page_no - 1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM complaints LIMIT :offset, :number_of_records");
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records", $this->NUMBER_OF_RECORDS_PER_PAGE);
        
        if($this->conn->executeQuery()) {
            return $this->conn->getResults();
        }
        return [];
    }

    /**
     * @param $complaint_id - int
     */
    public function deleteComplaint(int $complaint_id) : void {
        $this->conn->prepareQuery('DELETE FROM complaints WHERE id = :id');
        $this->conn->bind(":id",$complaint_id);

        if($this->conn->executeQuery()) {
            $_SESSION['complaint_deleted'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Complaint deleted.
            </div>";
            \header("location:complaints");
        } else {
            $_SESSION['error_complaint'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Problem deleting complaint
            </div>";
            \header("location:complaints");
        }
    }

    /**
     * @param $data - array
     * @param $user_id - int
     */
    public function updateUser(array $data, int $user_id) : void {
        \extract($data);

        if(empty($password)) {
            $this->conn->prepareQuery("UPDATE admin SET
                                            first_name = :first_name,
                                            last_name = :last_name,
                                            username = :username,
                                            email = :email WHERE id = :id");
            $this->conn->bind(":first_name",$first_name);
            $this->conn->bind(":last_name",$last_name);
            $this->conn->bind(":username",$username);
            $this->conn->bind(":email",$email);
            $this->conn->bind(":id",$user_id);
        } else {
            $this->conn->prepareQuery("UPDATE admin SET
                                            first_name = :first_name,
                                            last_name = :last_name,
                                            username = :username,
                                            password = :password,
                                            email = :email WHERE id = :id");
                $this->conn->bind(":first_name",$first_name);
                $this->conn->bind(":last_name",$last_name);
                $this->conn->bind(":username",$username);
                $this->conn->bind(":email",$email);
                $this->conn->bind(":password",$password);
                $this->conn->bind(":id",$user_id);
        }
        if( $this->conn->executeQuery()) {
            $_SESSION['profile_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> User Profile Updated.
          </div>";
               \header("location:../users");
           }else {
            $_SESSION['profile_error'] = 
            "<div class='alert alert-danger'>
                 <strong>Error Occured!</strong>
             </div>";
             \header("location:../users");
           }
    }
    /**
     * @param $user_id - int
     * @return bool
     */
    public function deleteUser(int $user_id) : bool {
        $this->conn->prepareQuery("DELETE FROM admin WHERE id = :id");
        $this->conn->bind(":id",$user_id);

        if($this->conn->executeQuery()) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getTotalPartnerRows() : int {
        $this->conn->prepareQuery("SELECT * FROM partner");
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

    /**
     * @return int
     */
    public function getTotalMerchantRows() : int {
        $this->conn->prepareQuery("SELECT * FROM merchant");
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

      /**
     * @return int
     */
    public function getTotalDeliveryRows() : int {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests");
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

    /**
     * @return int
     */
    public function getTotalUserRows() : int {
        $this->conn->prepareQuery("SELECT * FROM admin");
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

    /**
     * @return int
     */
    public function getTotalPages() : int {
        return $this->total_pages;
    }

      /**
     * @param $password - string
     * @return bool
     */
    public function isPasswordChanged(string $password) : bool {
        $this->conn->prepareQuery("SELECT * FROM admin WHERE password = :password");
        $this->conn->bind(":password",$password);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return false;
        }

        return true;
    }

    
    /**
     * @param $username - string
     * @return bool
     * - Checks whether username exists
     */
    private function usernameExists(string $username) : bool {
        $this->conn->prepareQuery("SELECT * FROM admin WHERE username = :username"); 
        $this->conn->bind(":username",$username);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }
        
        return false;
    }

    /**
     * @param $email - string
     * @return bool
     * - Checks whether user email exists
     */
    private function emailExists(string $email) : bool {
        $this->conn->prepareQuery("SELECT * FROM admin WHERE email = :email"); 
        $this->conn->bind(":email",$email);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $user_id - int
     * @return bool
     */
    private function findUserId(int $user_id) : bool {
        $this->conn->prepareQuery("SELECT * FROM admin WHERE id = :id");
        $this->conn->bind(":id",$user_id);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $user_id - int
     * @return object
     */
    public function getPartnerInfo(int $user_id) : object {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE partner_id = :id");
        $this->conn->bind(":id",$user_id);

        $this->conn->executeQuery();

        return $this->conn->getResult();
    }

    /**
     * @param $user_id - int
     */
    public function approvePartner(int $user_id) : void {
        $this->conn->prepareQuery("UPDATE partner SET
                                                account_status = :status WHERE partner_id = :id");
        $this->conn->bind(":status","Approved");
        $this->conn->bind(":id",$user_id);

        if($this->conn->executeQuery()) {
            \header("location:../partners");
        } 

        \header("location:../partners");
    }

    /**
     * @param $partner_id - int
     * @return string
     */
    public function getTotalWithdrawals(int $partner_id) : string {
        $this->conn->prepareQuery("SELECT withdrawals FROM partner WHERE partner_id = :id");
        $this->conn->bind(":id",$partner_id);

        if($this->conn->executeQuery()) {
            return strval($this->conn->getResult()->withdrawals);
        }

        return "";
    }

    /**
     * @param $data - array
     * @param $partner_id - int
     */
    public function approveWithdrawal(array $data, int $partner_id) : void {
        \extract($data);
        $this->conn->prepareQuery("UPDATE partner SET
                                                    withdrawals = :withdrawal
                                                         WHERE partner_id = :id");
        $this->conn->bind(":withdrawal",$total_withdrawals);
        $this->conn->bind(":id",$partner_id);

        if($this->conn->executeQuery()) {
            $this->updateWithdrawalStatus($partner_id,"Approved");
            $_SESSION['approved'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> withdrawal approved.
        </div>";
            \header("location:withdrawals");
        } else {
            $this->updateWithdrawalStatus($partner_id,"Rejected");
            $_SESSION['rejected'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> withdrawal rejected.
        </div>";
            \header("location:withdrawals");
        }
    }

    /**
     * @param $partner_id - int
     * @param $status - string
     * @return bool
     */
    public function updateWithdrawalStatus(int $partner_id, string $status) : bool {
        $this->conn->prepareQuery("UPDATE withdrawal_requests SET request_status = :status");
        $this->conn->bind(":status",$status);

        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getAllWithdrawalRequest() : array {
        $this->conn->prepareQuery('SELECT * FROM withdrawal_requests');
        $this->conn->executeQuery();

        return $this->conn->getResults();
    }

    /**
     * @param $user_id - int
     */
    public function revokePartner(int $user_id) : void {
        $this->conn->prepareQuery("UPDATE partner SET
                                                account_status = :status WHERE partner_id = :id");
        $this->conn->bind(":status","Under Review");
        $this->conn->bind(":id",$user_id);

        if($this->conn->executeQuery()) {
            \header("location:../partners");
        } 

        \header("location:../partners");
    }

    /**
     * @param $user_id - int
     * @return bool
     */
    public function deleteDeliveryRequest(int $user_id) : bool {
        $this->conn->prepareQuery("DELETE FROM delivery_requests WHERE partner_id = :id");
        $this->conn->bind(":id",$user_id);

        if($this->conn->executeQuery()) {
            return true;
        }

       return false;
    }

    /**
     * @param $user_id - int
     */
    public function deletePartner(int $user_id) : void {
        if($this->deleteDeliveryRequest($user_id)) {
            $this->conn->prepareQuery("DELETE FROM partner WHERE partner_id = :id");
            $this->conn->bind(":id",$user_id);

            if($this->conn->executeQuery()) {
                \header("location:partners");
            }

            \header("location:partners");
        }else {
            \header("location:partners");
        }
    }

    /**
     * @param $user_id - int
     * @return bool
     */
    public function deliveryExists(int $user_id) : bool {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE id = :id");
        $this->conn->bind(":id",$user_id);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $user_id - int
     * @return object
     */
    public function getDeliveryRequest(int $user_id) : object {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE id = :id");
        $this->conn->bind(":id",$user_id);
        $this->conn->executeQuery();

        return $this->conn->getResult();
    }

    /**
     * @param $data - array
     */
    public function updateDeliveryRequest(array $data) : void {
        \extract($data);
        $this->conn->prepareQuery("UPDATE delivery_requests
                                                        SET
                                                        to_location = :to_location,
                                                        from_location = :from_location,
                                                        receipient_name = :receipient_name,
                                                        sender_name = :sender_name,
                                                        receipient_mobile_number = :receipient_number,
                                                        sender_mobile_number = :sender_number WHERE id = :id");
        $this->conn->bind(":to_location",$to_location);
        $this->conn->bind(":from_location",$from_location);
        $this->conn->bind(":receipient_name",$receipient_name);
        $this->conn->bind(":sender_name",$sender_name);
        $this->conn->bind(":receipient_number",$receipient_number);
        $this->conn->bind(":sender_number",$sender_number);
        $this->conn->bind(":id",$id);

        if($this->conn->executeQuery()) {
            $_SESSION['updated'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Record Updated
            </div>";
            \header("location:deliveries");
            exit;
        }

        $_SESSION['error'] = 
        "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> An Error Occured
        </div>";
        \header("location:deliveries");
        exit;
    }

    /**
     * @return array
     */
    public function getTotalWeeklyRevenue() : array {
        $this->conn->prepareQuery("SELECT request_time,delivery_rates.*,SUM(delivery_rates.rate) as total_revenue,DAYOFWEEK(request_time) AS day
        FROM delivery_requests INNER JOIN delivery_rates ON delivery_rates.rate_id = delivery_requests.rate_id
        WHERE request_time >= Date_add(Now(),interval - 7 day) AND request_time <= NOW()
        group by DATE(request_time)
        ");
        if($this->conn->executeQuery()) {
            return $this->conn->getResults();
        }

        return [];
    }

}