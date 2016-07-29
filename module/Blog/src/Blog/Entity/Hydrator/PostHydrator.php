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
     * @param  Post $post
     * @return Post
     */
    public function extract(Post $post)
    {
        if (!$post instanceof Post) {
            return $post;
        }

        return array(
            'content' => $post->getContent(),
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'id' => $post->getId(),
        );
    }
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  Post $post
     * @return Post
     */
    public function hydrate(array $data, Post $post)
    {
        // only want this hydrator to be applicable to our Post object.
        if (!$post instanceof Post) {
            return $post;
        }
        $post->setCategory(isset($data['category']) ?: null);
        $post->setContent(isset($data['content']) ?: null);
        $post->setTitle(isset($data['title']) ?: null);
        $post->setSlug(isset($data['slug']) ?: null);
        $post->setId(isset($data['id']) ?: null);
    }

//put your code here
}
