<?php

namespace Blog;
use Zend\Db\Adapter\Adapter;
use Blog\Repository\PostRepositoryImpl;
use Blog\Service\BlogServiceImpl;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Used to register our services.
 */
// add services to the service manager.
return array(
    // use factory for DI.
    'factories' => array(
        'Blog\Repository\PostRepository' => function(ServiceLocatorInterface $serviceLocator) {
            // create our new implementation.
            $postRepository = new PostRepositoryImpl();
            // set the db adapter to that implementation
            $postRepository->setDbAdapter($serviceLocator->get('\Zend\Db\Adapter\Adapter'));
            // return PostRepository.
            return $postRepository;
        },
        'Blog\Service\BlogService' => function(ServiceLocatorInterface $serviceLocator) {
           // create new blog service
           $blogService = new BlogServiceImpl();
           $blogService->setPostRepository($serviceLocator->get('\Blog\Repository\PostRepository'));
           // return the blogservice
           return $blogService;
        },
    ),
);