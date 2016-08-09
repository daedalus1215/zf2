<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserServiceImpl
 *
 * @author ladams
 */
class UserServiceImpl implements \User\Service\UserService
{
    /**
     *
     * @var \User\Repository\UserRepository $userRepository
     */
    protected $userRepository;

    public function getUserRepository()
    {
        return $this->userRepository;
    }

    public function setUserRepository(\User\Repository\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        return $this;
    }

    public function add(\User\Service\User $user)
    {
        $this->userRepository->add($user);
    }

    public function delete(\User\Entity\User $user)
    {

    }

    public function findById($id)
    {

    }

    public function save(\User\Entity\User $user)
    {

    }

    public function update(\User\Entity\User $user)
    {

    }

}
