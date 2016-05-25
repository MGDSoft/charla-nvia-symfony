<?php


namespace AppBundle\Services;


use AppBundle\Entity\BlogPost;

class Mail
{
    private $mailer;

    function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailToUser(BlogPost $blogPost)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Blog was created: '.$blogPost->getTitle())
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody('Nvia me ama', 'text/html')
        ;

        $this->mailer->createMessage($message);
    }
}