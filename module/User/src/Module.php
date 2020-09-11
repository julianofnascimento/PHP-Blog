<?php

namespace User;

use User\Controller\Factory\AuthControllerFactory;
use User\Controller\AuthController;
use User\Service\Factory\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ConfigProviderInterface
{

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $container = $event->getApplication()->getServiceManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $event) use ($container) {
           $match = $event->getRouteMatch();

           $authService = $container->get(AuthenticationServiceInterface::class);
           $routeName = $match->getMatchedRouteName();
           if ($authService->hasIdentity()) {
               return;
           } elseif (strpos($routeName, 'admin') !== false) {
               $match->setParam('controller', AuthController::class)
                   ->setParam('action', 'login');
           }
        }, 100);
    }

    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig()
    {
        return [
            'aliases' => [
                AuthenticationService::class => AuthenticationServiceInterface::class
            ],

            'factories' => [
                AuthenticationServiceInterface::class => AuthenticationServiceFactory::class
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                AuthController::class => AuthControllerFactory::class
            ]
        ];
    }
}
