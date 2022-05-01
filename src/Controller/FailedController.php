<?php

namespace App\Controller;

use App\Repository\FailedMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class FailedController extends AbstractController
{
    #[Route('/failed', name: 'app_failed')]
    public function index(FailedMessageRepository $failedMessageRepository): Response
    {

        return $this->render('failed/index.html.twig', [
            'messages' => $failedMessageRepository->findAll(),
        ]);
    }

    #[Route('/failed/resend/{id}', name: 'app_failed_resend')]
    public function resend(int $id, FailedMessageRepository $failedMessageRepository, MessageBusInterface $messageBus)
    {

        $message = $failedMessageRepository->find($id)->getMessage();

        $messageBus->dispatch($message);

        $failedMessageRepository->delete($id);

        $this->addFlash('success', 'Message Send && Removed!');

        return $this->redirectToRoute('app_failed');
    }

    #[Route('/failed/remove/{id}', name: 'app_failed_remove')]
    public function remove(int $id, FailedMessageRepository $failedMessageRepository)
    {

        $failedMessageRepository->delete($id);

        $this->addFlash('success', 'Message Removed!');

        return $this->redirectToRoute('app_failed');
    }
}
