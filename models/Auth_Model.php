<?php declare(strict_types=1);

namespace edelivery\models;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Auth_Model {

    private object $conn;

    public function __construct(object $connection) {
        $this->conn = $connection;
    }

    /**
     * @param $token - string
     * @param $email - string
     */
    public function sendPasswordResetNotification(string $token, string $email) : void {
        $this->resetPassword($token, $email);
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'sambasallah10@gmail.com';                     // SMTP username
            $mail->Password   = '!@+Y7enqxal';                               // SMTP password
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
}