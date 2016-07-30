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
     * @param Post $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Post || $object->getCategory() == null) {
            return $object;
        }

        $category = $object->getCategory();

        return [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' =>$category->getSlug(),
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
        $category = new Category();
        $category->setId(isset($data['category_id']) ? intval($data['category_id']) : null);
        $category->setName(isset($data['name']) ? $data['name'] : null);
        $category->setSlug(isset($data['category_slug']) ? $data['category_slug'] : null);
        $object->setCategory($category);

        return $object;
    }

//put your code here
}
