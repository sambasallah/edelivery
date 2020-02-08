<?php declare(strict_types=1);

namespace edelivery\models;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Reset_Password_Model {

    private object $conn;
    private string $merchant;
    private string $partner;

    public function __construct(object $connection) {
        $this->conn = $connection;
        $this->partner = '';
        $this->merchant = '';
    }

    /**
     * @param string $token
     * @param string $email
     */
    public function sendPasswordResetNotification(string $token, string $email) : void {

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp-relay.sendinblue.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'sambasallah10@gmail.com';                     // SMTP username
            $mail->Password   = 'zLtJOqwH32hGxAV8';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('reset@edelivery.com','Reset Password');
            $mail->addReplyTo('reset@edelivery.com', 'Reset Password');
            $mail->addAddress($email);     // Add a recipient
        

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body = 'Password Reset Request<br>';
            $mail->Body .= 'This is your temporal password <b>'.$token.'</b> use it to sign in';

            if($mail->send()) {
                $this->resetPassword($token, $email);
                $_SESSION['redirect_success'] = true;
                header('location:reset-success');
            } else {
                header('location:reset-password');
            }
            
        } catch (Exception $e) {
            $_SESSION['error_reset'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            \header('location:reset-password');
        }
    }

    /**
     * @param $token - string
     * @param $email - string
     * @return bool
     */
    public function resetPassword(string $token, $email) : bool {
        $this->conn->prepareQuery("INSERT INTO reset_password SET token = :token, email = :email");
        $this->conn->bind(":token", $token);
        $this->conn->bind(":email",$email);
        
        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }
    

    /**
     * @return string
     */
    public function generateToken() : string {
        return "EDV".rand(0,time()-1);
    }

    /**
     * @param $token - string
     * @return string
     */
    public function getEmail(string $token) : string {
        $this->conn->prepareQuery("SELECT email FROM reset_password WHERE token = :token");
        $this->conn->bind(":token", $token);

        if($this->conn->executeQuery()) {
            return $this->conn->getResult()->email;
        } else {
            return "Invalid Token";
        }
    }

    /**
     * @param $email - string
     * @param $data - array
     */
    public function changePassword(string $email, array $data) : void {
        \extract($data);

        if($password1 == $password2 && $this->emailExists($email)) {
            $password = \password_hash($password1, PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads'=> 4]);

            if(strlen($this->partner) > 0) {
                $success = $this->changePartnerPassword($password, $email);
                if($success) {
                    \header('location:login');
                } else {
                    \header('location:reset-password');
                }
            } else if(strlen($this->merchant) > 0) {
                $success = $this->changeMerchantPassword($password, $email);
                if($success) {
                    \header('location:login');
                } else {
                    \header('location:reset-password');
                }
            } else {
                \header('location:login');
            }

            
        }
    
    }

    /**
     * @param $password - string
     * @param $email - string
     * @return bool
     */
    private function changePartnerPassword(string $password, string $email) : bool {
        $this->conn->prepareQuery("UPDATE partner SET password = :password WHERE email = :email");
        $this->conn->bind(":password", $password);
        $this->conn->bind(":email", $email);

        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }

    /**
     * @param $password - string
     * @param $email - string
     * @return bool
     */
    private function changeMerchantPassword(string $password, string $email) : bool {
        $this->conn->prepareQuery("UPDATE merchant SET password = :password WHERE email = :email");
        $this->conn->bind(":password", $password);
        $this->conn->bind(":email", $email);

        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }

    /**
     * @param $email - string
     * @return bool
     */
    private function emailExists(string $email) : bool {
        if($this->emailExistsInPartner($email)) {
            $this->partner = "partner";
            return true;
        } else if ($this->emailExistsInMerchant($email)) {
            $this->merchant = "merchant";
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $email - string
     * @return bool
     */
    private function emailExistsInPartner(string $email) : bool {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE email = :email");
        $this->conn->bind(":email", $email);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $email - string
     * @return bool
     */
    private function emailExistsInMerchant(string $email) : bool {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE email = :email");
        $this->conn->bind(":email", $email);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }
}