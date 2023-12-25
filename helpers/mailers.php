<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/PHPMailer/src/PHPMailer.php";
require_once __DIR__ . "/PHPMailer/src/SMTP.php";
require_once __DIR__ . "/PHPMailer/src/Exception.php";


class Maillers
{
    private string $host;
    private string $username;
    private string $password;
    private string $SMTPSecure;
    private int $port;
    private string $from;
    private string $fromName;

    public function __construct()
    {
        $this->host = env('MAIL_HOST');
        $this->username = env('MAIL_USERNAME');
        $this->password = env('MAIL_PASSWORD');
        $this->SMTPSecure = env('MAIL_ENCRYPTION');
        $this->port = env('MAIL_PORT');
        $this->from = env('MAIL_FROM_ADDRESS');
        $this->fromName = env('MAIL_FROM_NAME');

    }


    public function sendMail($email, $subject, $body)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $this->host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port = $this->port;
            $mail->setFrom($this->from, $this->fromName);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
