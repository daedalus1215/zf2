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
     * @var int $id
     */
    protected $id;

    /**
     *
     * @return int
     */
    function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param int $id
     */
    function setId($id)
    {
        $this->id = $id;
    }

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
     * @var string
     */
    protected $content;

    /**
     *
     * @var Category
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

    /**
     *
     * @return \Blog\Entity\Category
     */
    function getCategory()
    {
        return $this->category;
    }

    /**
     *
     * @param string $title
     */
    function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     *
     * @param string $slug
     */
    function setSlug($slug)
    {
        $this->slug = $slug;
    }

    function setContent($content)
    {
        $this->content = $content;
    }

    /**
     *
     * @param \Blog\Entity\Category $category
     */
    function setCategory(Category $category)
    {
        $this->category = $category;
    }

}
