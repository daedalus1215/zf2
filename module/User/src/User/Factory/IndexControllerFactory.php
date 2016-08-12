<?php
namespace User\Factory;

use User\Controller\IndexController as UserController;
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
        $indexController = new UserController($serviceManager);
        return $indexController;
    }

}
