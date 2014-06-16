<?php
namespace Application\Factory;

use Application\Controller\FatturaController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FatturaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm         = $serviceLocator->getServiceLocator();
        $controller = new FatturaController();
        return $controller;
    }
}