<?php

namespace App\Service;

use App\Entity\User;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Psr\Log\LoggerInterface;

class SendNewsletterService {

    private LoggerInterface $logger;


    public function __construct(LoggerInterface $logger)
    {
      $this->logger = $logger;
    }

    public function send(User $user, $message): Bool
    {

      try {

        sleep(1);
        //return new Exception('error');

      } catch(Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
        $this->logger->error('An error occurred' .  $e->getMessage());
      }

      return true;
      
    }
}