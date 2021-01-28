<?php

namespace App\Notification;

use App\Entity\Command;
use Twig\Environment;

class CommandNotification {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {

        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }
    public function notify(Command $command) {
        $message = (new \Swift_Message('Carhub : ' . $command->getProduit()->getTitre()))
            ->setFrom('noreply@carhub.com')
            ->setTo('client@carhub.com')
            ->setReplyTo($command->getEmail())
            ->setBody($this->renderer->render('email/command.html.twig', [
                'command' => $command
            ]), 'text/html');
        $this->mailer->send($message);
    }

}