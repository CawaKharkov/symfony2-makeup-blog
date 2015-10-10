<?php

namespace AppBundle\Listener\Doctrine;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class DoctrineExtensionListener extends ContainerAware
{
    public function onLateKernelRequest(GetResponseEvent $event)
    {
        $translatable = $this->container->get('gedmo.listener.translatable');
        $translatable->setTranslatableLocale($event->getRequest()->getLocale());
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $securityContext = $this->container->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE);

        if (null !== $securityContext &&
            null !== $securityContext->getToken() &&
            $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            $loggable = $this->container->get('gedmo.listener.loggable');
            $loggable->setUsername($securityContext->getToken()->getUsername());
        }
    }
}