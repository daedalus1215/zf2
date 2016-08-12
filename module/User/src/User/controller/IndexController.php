<?php

namespace User\Controller;

use User\Form\Add;
use User\Service\UserService;
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
    public function __construct(\Zend\ServiceManager\ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }

    public function indexAction()
    {
        //@TODO stopped here.
        //$dbAdapter = $serviceManager->get('Zend');


        return new ViewModel();
    }
    
    public function addAction() 
    {
        $form = new Add();
        
        if ($this->request->isPost()) {
            $user = new User();
            
            $form->bind($user);
            $form->setInputFilter($this->getServiceLocator()->get('User\InputFilter\AddUser'));
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                $user->setUserGroup(UserService::GROUP_REGULAR);
                $this->getUserService()->add($user);
                $this->flashMessenger()->addSuccessMessage('The user has been added!');
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    /**
     * 
     * @return UserService
     */
    protected function getUserService()
    {
        return $this->serviceManager->get('User\Service\UserService');
    }
    
}
