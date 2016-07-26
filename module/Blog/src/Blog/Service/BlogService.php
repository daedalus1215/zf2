<?php

namespace Blog\Service;

/**
 * Description of BlogService
 *
 * @author ladams
 */
interface BlogService
{
    /**
     * Saves post
     * @param \Blog\Service\Post $post
     */
    public function save(Post $post);
}
