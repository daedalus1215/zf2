<?php
namespace Blog\Entity\Hydrator;

use Blog\Entity\Post;
use Zend\Hydrator\HydratorInterface;
/**
 * Description of PostHydrator
 *
 * @author ladams
 */
class PostHydrator implements HydratorInterface
{
    /**
     * Extract values from an object
     *
     * @param  Post $object
     * @return Post
     */
    public function extract( $object)
    {
        if (!$object instanceof Post) {
            return $object;
        }

        return array(
            'content' => $object->getContent(),
            'title' => $object->getTitle(),
            'slug' => $object->getSlug(),
            'id' => $object->getId(),
        );
    }
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  Post $object
     * @return Post
     */
    public function hydrate(array $data,  $object)
    {
        // only want this hydrator to be applicable to our Post object.
        if (!$object instanceof Post) {
            return $object;
        }
        /**
         * @var Blog\Entity\Post $object
         */
        $object->setCategory(isset($data['category']) ?: null);
        $object->setContent(isset($data['content']) ?: null);
        $object->setTitle(isset($data['title']) ?: null);
        $object->setSlug(isset($data['slug']) ?: null);
        $object->setId(isset($data['id']) ?: null);
    }

}
