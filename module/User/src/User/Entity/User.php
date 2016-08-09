<?php

/**
 * Description of User
 *
 * @author ladams
 */
class User
{
    /**
     *
     * @var int
     */
    protected $id;
    /**
     *
     * @var string $firstName
     */
    protected $firstName;
    /**
     *
     * @var string $lastName
     */
    protected $lastName;
    /**
     *
     * @var string $username
     */
    protected $username;
    /**
     *
     * @var string $email
     */
    protected $email;
    /**
     *
     * @var string
     */
    protected $createdDate;
    /**
     *
     * @var string
     */
    protected $userGroup;
    /**
     *
     * @var string
     */
    protected $authorId;
    /**
     *
     * @var string $password
     */
    protected $password;

    
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     *
     * @return $string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    /**
     *
     * @return int
     */
    public function getUserGroup()
    {
        return $this->userGroup;
    }
    /**
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }
    /**
     *
     * @param string $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }
    /**
     *
     * @param int $userGroup
     */
    public function setUserGroup($userGroup)
    {
        $this->userGroup = $userGroup;
    }
    /**
     *
     * @param int $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }



    /**
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param type $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}
