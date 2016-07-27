<?php

namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Form\Add;
use Blog\InputFilter\AddPost;
use Blog\Service\BlogService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
        $form = new Add();
        $variables = array('form' => $form);

        if ($this->request->isPost()) {
            $blogPost = new Post();
            $form->bind($blogPost);
            $form->setInputFilter(new AddPost()); //Add the input filter when the form is submitted.
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                /**
                 * @var BlogService $blogService
                 */
                $blogService = $this->getServiceLocator()->get('Blog\Service\BlogService');
                $blogService->save($blogPost);
                $variables['success'] = true;
            }
        }

        return new ViewModel($variables);
    }
}