<?php
namespace Application\Factory;

use Application\Controller\ConfigurazioneController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigurazioneFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm         = $serviceLocator->getServiceLocator();
        $controller = new ConfigurazioneController();
        return $controller;
    }
}