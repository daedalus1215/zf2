<?php
namespace Blog\Entity;

/**
 * Description of Post
 *
 * @author ladams
 */
class Post
{
    /**
     *
     * @var String
     */
    protected $title;
    /**
     *
     * @var String
     */
    protected $slug;
    /**
     *
     * @var String
     */
    protected $content;
    /**
     *
     * @var String
     */
    protected $category;

    function getTitle()
    {
        return $this->title;
    }

    function getSlug()
    {
        return $this->slug;
    }

    function getContent()
    {
        return $this->content;
    }

    function getCategory()
    {
        return $this->category;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setSlug( $slug)
    {
        $this->slug = $slug;
    }

    function setContent( $content)
    {
        $this->content = $content;
    }

    function setCategory( $category)
    {
        $this->category = $category;
    }

}
