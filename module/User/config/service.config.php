<?php

return [
    'factories' => array(
        'User\InputFilter\AddUser' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
            return new \User\InputFilter\AddUser($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        },
    ),
];

