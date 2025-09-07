<?php

namespace Builov\Vertolet\Infrastructure;

use Builov\Vertolet\Application\EmailerInterface;
use Builov\Vertolet\VO\EmailAttachment;
use Builov\Vertolet\VO\EmailBody;
use Builov\Vertolet\VO\EmailSubject;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Emailer implements EmailerInterface
{
    private EmailSubject $subject;
    private EmailBody $body;
    private EmailBody $altBody;
    private EmailAttachment $attachment;

    public function setSubject($str)
    {
        $this->subject = new EmailSubject($str);
        return $this;
    }

    public function setBody($str)
    {
        $this->body = new EmailBody($str);
        return $this;
    }

    public function setAltBody($str)
    {
        $this->altBody = new EmailBody($str);
        return $this;
    }

    public function setAttachment($path)
    {
        //todo если такой файл существует и соответствует требованиям
        $this->attachment = new EmailAttachment($path);
        return $this;
    }

    public function mail(): void
    {
        $mail = new PHPMailer(true);

        try {
//          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->CharSet    = 'UTF-8';
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = SMTP_PORT;

            $mail->setFrom(SMTP_FROM_DEFAULT, SMTP_FROM_DEFAULT_NAME);
//            $mail->addAddress('5905@lst.gr', 'Joe User');
            $mail->addAddress(SMTP_TO_DEFAULT);               //Name is optional
            $mail->addReplyTo(SMTP_REPLY_DEFAULT, SMTP_REPLY_DEFAULT_NAME);
//          $mail->addCC('cc@example.com');
//          $mail->addBCC('bcc@example.com');

            if (isset($this->attachment)) {
                $mail->addAttachment($this->attachment);
//              $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            }

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            $mail->AltBody = $this->altBody;

            $mail->send();
        } catch (Exception $e) {
//            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            throw new Exception($e->getMessage());
        }
    }
}