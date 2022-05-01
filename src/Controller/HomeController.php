<?php

namespace App\Controller;


use App\Repository\UserRepository;
use App\Message\SendNewsletterMessage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MessageBusInterface $messageBus, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        foreach($users as $key =>  $user){
            $message = "message : " . $key . " ";
            
            $messageBus->dispatch(new SendNewsletterMessage($user->getId(), $message));

            $this->addFlash('success', $message . 'OK');
        }


        return $this->render('home/index.html.twig', [
        ]);
    }
}
