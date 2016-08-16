<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        // The name of the namespace we want to have access to our session container.
        $namespace = 'user';
        // Testing session functionality
        $container = new Container($namespace); // create session container
        // Add variables to the session container.
        $container->name = 'Larry Adams';
        $container->website = 'larry-adams.info';

        return new ViewModel();
    }
}
