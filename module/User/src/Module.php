<?php

namespace User;

use User\Controller\AuthController;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [

            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                AuthController::class => InvokableFactory::class
            ]
        ];
    }
}
