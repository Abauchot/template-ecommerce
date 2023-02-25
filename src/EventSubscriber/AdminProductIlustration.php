<?php

namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminProductIlustration implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return[
          BeforeEntityPersistedEvent::class
        ];
    }
}