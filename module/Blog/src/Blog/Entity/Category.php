<?php

namespace Blog\Entity;

/**
 * Description of Category
 *
 * @author ladams
 */
class Category
{

    /**
     *
     * @var string
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
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $slug;

    /**
     *
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    function getSlug()
    {
        return $this->slug;
    }

    /**
     *
     * @return string
     */
    function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @return string
     */
    function setSlug($slug)
    {
        $this->slug = $slug;
    }

}
