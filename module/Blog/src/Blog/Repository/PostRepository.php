<?php
namespace Blog\Repository;

use Blog\Entity\Post;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostRepository
 *
 * @author ladams
 */
interface PostRepository
{
    /**
     *
     * @param Post $post
     */
    public function save(Post $post);
}
