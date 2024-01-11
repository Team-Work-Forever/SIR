<?php

namespace Config\Mail;

require __DIR__ . '/../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use Config\Twig\Twig;

class MailSender
{
    private $mcMail = "no-replay@mestresdaculinaria.pt";
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Host = 'sandbox.smtp.mailtrap.io';
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = '93eacd616772c1';
        $this->mailer->Password = '22ad98c07a63bf';
    }

    public function send($to, $subject, $template, $data = [])
    {
        $this->mailer->setFrom($this->mcMail);
        $this->mailer->addAddress($to);
        $this->mailer->Subject = $subject;
        $this->mailer->isHTML(true);
        $this->mailer->Body = Twig::getTemplateRenderer("../../templates")->render("mail/" . $template . ".twig", $data);

        // Send the message
        $this->mailer->send();
    }
}
