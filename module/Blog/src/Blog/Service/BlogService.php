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
     *
     * @return Post[]
     */
    public function fetchAll();
}
