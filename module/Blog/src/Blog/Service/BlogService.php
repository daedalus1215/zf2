<?php

namespace Blog\Service;

use Blog\Entity\Post;

/**
 * Description of BlogService
 *
 * @author ladams
 */
interface BlogService
{
    /**
     *
     * @param Post $post
     */
    public function save(Post $post);
    /**
     * Fetches all blog posts
     * @param int $page
     * @return \Zend\Paginator\Paginator
     */
    public function fetch($page);
    /**
     *
     * @param $categorySlug
     * @param $postSlug
     * @return Post|null
     */
    public function find($categorySlug, $postSlug);
}
