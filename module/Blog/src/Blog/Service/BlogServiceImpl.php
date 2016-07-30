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
     * Fetches all blog posts
     * @return Post[]
     */
    public function fetchAll()
    {
        return $this->postRepository->fetchAll();
    }

}
