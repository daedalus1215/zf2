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
            return array();
        }

        return array(
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'slug' => $object->getSlug(),
            'content' => $object->getContent(),
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
         * @var Post $object
         */
        $object->setId(isset($data['id']) ? $data['id']: null);
        $object->setTitle(isset($data['title']) ? $data['title']: null);
        $object->setSlug(isset($data['slug']) ? $data['slug']: null);
        $object->setContent(isset($data['content']) ? $data['content']: null);

        return $object;
    }

}
