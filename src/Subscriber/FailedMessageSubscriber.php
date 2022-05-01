<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;

class FailedMessageSubscriber implements EventSubscriberInterface 
{

    public static function getSubscribedEvents()
    {

        return [
            WorkerMessageFailedEvent::class => 'onMessageFailed'
        ];
        
    }

    public function onMessageFailed(WorkerMessageFailedEvent $event) {

        // recuperation du message d'erreur
        $error = get_class($event->getEnvelope()->getMessage());

        // recuperation de la trace de l'erreur
        $trace = $event->getThrowable()->getTraceAsString();
    }
}