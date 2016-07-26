<?php

namespace Blog;
/**
 * Used to register our services.
 */
// add services to the service manager.
return array(
    'invokables' => array(
        // when someone calls
        // $serivceLocator->get('Blog\Service\BlogService')...
        // it will return...
        // ... Blog\Service\BlogServiceImpl
        'Blog\Service\BlogService' => 'Blog\Service\BlogServiceImpl'
    ),
);