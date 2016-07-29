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
     * @param Category $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Post || $object->getCategory() == null) {
            return $object;
        }

        $category = $object->getCategory();

        return [
            'name' => $category->getName(),
            'slug' =>$category->getSlug(),
            'id' => $category->getId()
        ];
    }

    /**
     *
     * @param array $data
     * @param Post $object
     * @return Post
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof Post) {
            return $object;
        }
        $category = new \Blog\Entity\Category();
        $category->setName(isset($data['name']) ?:null);
        $category->setSlug(isset($data['slug']) ?:null);
        $category->setId(isset($data['id']) ?:null);
        $object->setCategory($category);

        return $object;
    }

//put your code here
}
