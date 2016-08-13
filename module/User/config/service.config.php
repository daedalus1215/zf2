<?php

use User\InputFilter\AddUser;
use User\Service\UserServiceImpl;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

return [
    'invokables' => array(
        'User\Repository\UserRepository' => 'User\Repository\UserRepositoryImpl',
    ),
    
    'factories' => array(
        'User\InputFilter\AddUser' => function(ServiceLocatorInterface $serviceLocator) {
            return new \User\InputFilter\AddUser($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        },
                
        'User\InputFilter\Login' => function(ServiceLocatorInterface $serviceLocator) {
            return new \User\InputFilter\Login($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        },
        
        'User\Service\UserService' => function(ServiceLocatorInterface $serviceLocator) {
            $userService = new UserServiceImpl();
            $userService->setUserRepository($serviceLocator->get('User\Repository\UserRepository'));
            
            return $userService;
        }                
    ),
            
    'initializers' => array(
        function($instance, ServiceLocatorInterface $serviceManager)
        {
            if ($instance instanceof AdapterAwareInterface) {
                $instance->setDbAdapter($serviceManager->get('\Zend\db\Adapter\Adapter'));
            }
        }
    ),
];

