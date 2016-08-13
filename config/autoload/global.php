<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
      'driver'         => 'Pdo',
      'dsn'            => 'mysql:dbname=zf2learn;host=localhost',
       'username'      => 'root',
       'password'      => ''
   ),    
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            // now all view helpers have this factory available and by extension the authentication Adapter
            'Zend\Authentication\AuthenticationService' => function(\Zend\ServiceManager\ServiceLocatorAwareInterface $serviceLocator) {
                /**
                 * @var \User\Service\UserService $userService
                 */
                $userService = $serviceLocator->get('User\Service\UserService');               
                return $userService->getAuthenticationService();
            }
      ),
    )
);
