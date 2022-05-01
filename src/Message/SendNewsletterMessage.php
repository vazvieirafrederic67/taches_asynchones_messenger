<?php

namespace App\Message;

final class SendNewsletterMessage
{
    private $userId;
    private $message;

    public function __construct(int $userId, string $message)
    {
        $this->message = $message;
        $this->userId = $userId;
    }

   public function getMessage(): string
   {
       return $this->message;
   }

   public function getUserId(): int
   {
       return $this->userId;
   }
}
