<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\SendNewsletterMessage;
use App\Service\SendNewsletterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendNewsletterMessageHandler implements MessageHandlerInterface
{

    private EntityManagerInterface $em;
    private SendNewsletterService $newsLetterService;

    public function __construct(EntityManagerInterface $em, SendNewsletterService $newsletterService)
    {
        $this->em = $em;
        $this->newsLetterService = $newsletterService;
    }

    public function __invoke(SendNewsletterMessage $message)
    {
        // do something with your message
        $user = $this->em->find(User::class, $message->getUserId());
        $this->newsLetterService->send($user, $message->getMessage());
        
    }
}
