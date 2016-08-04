<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Description of IndexController
 *
 * @author ladams
 */
class IndexController extends AbstractActionController
{
    /**
     *
     * @var \Zend\ServiceManager\ServiceManager $serviceManager
     */
    protected $serviceManager;
    /**
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(\Zend\ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }
    public function indexAction()
    {
        return new ViewModel();
    }
}
