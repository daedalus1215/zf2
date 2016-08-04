<?php
namespace Blog\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of IndexContollerFactory
 *
 * @author the_admin
 */
class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
        $serviceManager = $serviceLocator->getServiceLocator();
        $indexController = new \Blog\Controller\IndexController($serviceManager);
        return $indexController;
    }

}
