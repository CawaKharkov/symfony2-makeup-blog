<?php

namespace AppBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'ru')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
      //  var_dump($request->query->get('locale'));
      //  die();
        if ($locale = $request->query->get('locale')) {
            $request->getSession()->set('locale', $locale);
            $request->setLocale($request->getSession()->get('locale'));
        } else {
            if ($request->getSession()->has('locale')) {
                $request->setLocale($request->getSession()->get('locale'));
            } else {

                $request->setLocale($this->defaultLocale);
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => [['onKernelRequest', 17]]];
    }
}