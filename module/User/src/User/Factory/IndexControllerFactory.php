<?php
namespace User\Factory;


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
        $indexController = new \User\Controller\IndexController($serviceManager);
        return $indexController;
    }

}
