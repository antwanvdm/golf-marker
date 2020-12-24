<?php namespace System;

use SendGrid\Mail\Mail as SendGridMail;

/**
 * Class Mail
 * @package System
 */
class Mail
{
    private \SendGrid $sendgrid;
    private SendGridMail $mail;
    private string $template;

    /**
     * Mail constructor.
     * @param \SendGrid $sendgrid
     */
    public function __construct(\SendGrid $sendgrid)
    {
        $this->sendgrid = $sendgrid;
        $this->mail = new SendGridMail();
    }

    /**
     * @param $templateFileName
     * @param array $variables
     * @return void
     */
    public function setTemplate($templateFileName, array $variables): void
    {
        extract($variables);
        ob_start();
        require INCLUDES_PATH . "templates/$templateFileName.php";
        $this->template = ob_get_clean();
    }

    /**
     * @param $emailAddress
     * @return bool
     * @throws \SendGrid\Mail\TypeException
     */
    public function send($emailAddress): bool
    {
        $this->mail->setFrom("antwanvdm@gmail.com", "Golf Marker");
        $this->mail->setSubject("Nieuwe marker gevonden!");
        $this->mail->addTo($emailAddress);
        $this->mail->addContent(
            "text/html", $this->template
        );

        try {
            $response = $this->sendgrid->send($this->mail);
//            print $response->statusCode() . "\n";
//            print_r($response->headers());
//            print $response->body() . "\n";
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
