<?php

namespace AppBundle\Listener;

use AppBundle\Exception\ArrayErrorsException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\InsufficientAuthenticationException;
use Symfony\Component\Translation\TranslatorInterface;

class ExceptionListener
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $response = new JsonResponse;
        $response->setData(['message' => $exception->getMessage()]);

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ('RuntimeException' === get_class($exception)) {
            $response->setStatusCode($exception->getCode());
        }

        if ($exception instanceof ArrayErrorsException) {
            $response->setData(['formErrors' => $exception->getErrors()]);
        }

        if ($exception instanceof AuthenticationException) {
            $response->setData(['message' => $exception->getMessageKey()]);
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof InsufficientAuthenticationException) {
            $response->setData(['message' => $this->translator->trans('error.insufficient_authentication')]);
            $response->setStatusCode(JsonResponse::HTTP_FORBIDDEN);
        }

        $event->setResponse($response);
    }
}
