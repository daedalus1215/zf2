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

    public function indexAction()
    {
        return new ViewModel();
    }
}
