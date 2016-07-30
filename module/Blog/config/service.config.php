<?php

namespace Blog;

use Blog\Repository\PostRepositoryImpl;
use Blog\Service\BlogServiceImpl;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Used to register our services.
 */
// add services to the service manager.
return array(
    'invokables' => array(
        'Blog\Repository\PostRepository' => 'Blog\Repository\PostRepositoryImpl'
    ),
    // use factory for DI.
    'factories' => array(
//        'Blog\Repository\PostRepository' => function(ServiceLocatorInterface $serviceLocator) {
//            // create our new implementation.
//            $postRepository = new PostRepositoryImpl();
//            // set the db adapter to that implementation
//            $postRepository->setDbAdapter($serviceLocator->get('\Zend\Db\Adapter\Adapter'));
//            // return PostRepository.
//            return $postRepository;
//        },
        'Blog\Service\BlogService' => function(ServiceLocatorInterface $serviceLocator) {
           // create new blog service
           $blogService = new BlogServiceImpl();
           $blogService->setBlogRepository($serviceLocator->get('\Blog\Repository\PostRepository'));
           // return the blogservice
           return $blogService;
        },
    ),
    // This block of code is run for every service that is retrieved with the service manager
    'initializers' => array(
        function($instance, ServiceLocatorInterface $serviceLocator) {
            if ($instance instanceof AdapterAwareInterface) {
                $instance->setDbAdapter($serviceLocator->get('\Zend\Db\Adapter\Adapter'));
            }
        }
    ),
);