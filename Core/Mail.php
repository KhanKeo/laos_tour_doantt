<?php
class Mail {
    private static function init() {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $GLOBALS['mail_host'];
        $mail->Port = $GLOBALS['mail_port'];
        $mail->SMTPSecure = $GLOBALS['mail_SMTPSecure'];
        $mail->SMTPAuth = $GLOBALS['mail_SMTPAuth'];
        $mail->Username = $GLOBALS['mail_username'];
        $mail->Password = $GLOBALS['mail_password'];
        $mail->FromName = $GLOBALS['mail_fromName'];
        $mail ->CharSet = "UTF-8"; 
        return $mail;
    }

    public static function send(string|array $to, string $subject, string $message, string|array $attachments = []) {
        $mail = Mail::init();

        if (gettype($to) == 'string')
            $mail->addAddress($to);
        else if (gettype($to) == 'array') {
            foreach ($to as $address)
                $mail->addAddress($address);
        }

        if (gettype($attachments) == 'string')
            $mail->addAttachment($attachments);
        else if (gettype($attachments) == 'array') {
            foreach ($attachments as $attachment)
                $mail->addAttachment($attachment);
        }

        $mail->Subject = $subject;
        $mail->msgHTML($message);

        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}