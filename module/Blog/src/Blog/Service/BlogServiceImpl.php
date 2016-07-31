<?php

namespace Blog\Service;

use Blog\Entity\Post;
use Blog\Repository\PostRepository;
use Blog\Service\BlogService;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogServiceImpl
 *
 * @author ladams
 */
class BlogServiceImpl implements BlogService
{

    /**
     * @var PostRepository $postRepository
     */
    protected $postRepository;


    /**
     *
     * @param Post $post
     */
    public function save(Post $post)
    {
        $this->postRepository->save($post);
    }

    function getBlogRepository()
    {
        return $this->postRepository;
    }

    /**
     *
     * @param PostRepository $postRepository
     */
    function setBlogRepository($postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     *
     * @param type $page
     * @return type
     */
    public function fetch($page)
    {
        /**
         * @var \Zend\Paginator\Paginator $paginator;
         */
        $paginator = $this->postRepository->fetch($page);
        return $paginator;
    }

    public function find($categorySlug, $postSlug)
    {
        return $this->postRepository->find($categorySlug, $postSlug);
    }

    public function findById($postId)
    {
        return $this->postRepository->findById($postId);
    }

    public function update(Post $post)
    {
        $this->postRepository->update($post);
    }

}
