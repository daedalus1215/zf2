<?php
namespace Blog\Entity;

/**
 * Description of Post
 *
 * @author ladams
 */
class Post
{
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

    function setTitle(String $title)
    {
        $this->title = $title;
    }

    function setSlug(String $slug)
    {
        $this->slug = $slug;
    }

    function setContent(String $content)
    {
        $this->content = $content;
    }

    function setCategory(String $category)
    {
        $this->category = $category;
    }

    


}
