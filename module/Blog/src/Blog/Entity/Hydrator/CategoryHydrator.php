<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Entity\Hydrator;

use Blog\Entity\Category;
use Blog\Entity\Post;
use Zend\Hydrator\HydratorInterface;

/**
 * Description of CategoryHydrator
 *
 * @author ladams
 */
class CategoryHydrator implements HydratorInterface
{
    /**
     *
     * @param Category $post
     * @return array
     */
    public function extract(Post $post)
    {
        if (!$post instanceof Post || $post->getCategory() == null) {
            return $post;
        }

        $category = $post->getCategory();

        return [
            'name' => $category->getName(),
            'slug' =>$category->getSlug(),
            'id' => $category->getId()
        ];
    }

    /**
     *
     * @param array $data
     * @param Post $post
     * @return Post
     */
    public function hydrate(array $data, Post $post)
    {
        if (!$post instanceof Post) {
            return $post;
        }
        $category = new \Blog\Entity\Hydrator\Category();
        $category->setName(isset($data['name']) ?:null);
        $category->setSlug(isset($data['slug']) ?:null);
        $category->setId(isset($data['id']) ?:null);
        $post->setCategory($category);

        return $post;
    }

//put your code here
}
