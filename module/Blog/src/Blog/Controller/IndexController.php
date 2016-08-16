<?php

namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Form\Add;
use Blog\Form\Edit;
use Blog\InputFilter\AddPost;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{



    /**
     *
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;
    /**
     *
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(\Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;


    }

    /**
     *
     * @return BlogService
     */
    protected function getBlogService()
    {
        return $this->serviceManager->get('Blog\Service\BlogService');
    }


    public function indexAction()
    {
        $this->layout('layout/user'); // trying to attach the new layout to blog module rotues.


        $variables = [];
        /**
         * @var BlogService
         */
        $blogService = $this->getBlogService();
        $page = $this->params()->fromRoute('page'); // grab the :page url parameter.
        $variables['paginator'] = $blogService->fetch($page);

        // testing sessions
        $namespace = 'user';
        $container = new Container($namespace);
        $name = $container->name;
        $website = $container->website;


        return new ViewModel($variables);
    }

    /**
     * Add a new Post.
     * @return ViewModel
     */
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
                $blogService = $this->getBlogService();
                $blogService->save($blogPost);
                $this->flashMessenger()->addSuccessMessage('Post has been added.');
            }
        }

        return new ViewModel($variables);
    }

    public function viewPostAction()
    {
        $categorySlug = $this->params()->fromRoute('categorySlug');
        $postSlug = $this->params()->fromRoute('postSlug');
        $post = $this->getBlogService()->find($categorySlug, $postSlug);

        if ($post == null) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
        }

        return new ViewModel(array(
            'post' => $post,
        ));

    }

    public function editAction()
    {
        $form = new Edit();

        if ($this->request->isPost()) {
            $post = new Post();
            $form->bind($post);
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $blogService = $this->getBlogService();
                $blogService->update($post);
                $this->flashMessenger()->addSuccessMessage('Post has been updated!');
            }
        }else {
                $post = $this->getBlogService()->findById($this->params()->fromRoute('postId'));

                if ($post == null) {
                    $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
                } else {
                    $form->bind($post); // populate the form with the post.

                    $form->get('category_id')->setValue($post->getCategory()->getId());
                    $form->get('slug')->setValue($post->getSlug());
                    $form->get('id')->setValue($post->getId());
                }
            }

        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function deleteAction()
    {
        $postId = $this->params()->fromRoute('postId');
        /**
         * @var Blog\Service\BlogService $blogService
         */
        $blogService = $this->getBlogService();
        if ($blogService instanceof \Blog\Service\BlogService) {
            $post = $blogService->findById($postId);
            $blogService->delete($post);
            $this->flashMessenger()->addSuccessMessage($post->getTitle() . ' Post has been deleted');
            $this->redirect()->toRoute('blog');
        }
    }
}