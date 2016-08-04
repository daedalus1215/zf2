<?php
namespace User\Factory;

use User\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of IndexContollerFactory
 *
 * @author the_admin
 */
class IndexContollerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
        $serviceManager = $serviceLocator->getServiceLocator();
        $indexController = new IndexController($serviceManager);
        return $serviceManager;
    }

}
