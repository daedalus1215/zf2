<?php
namespace User\Service;

use User\Entity\User;
use User\Repository\UserRepository;
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
class UserServiceImpl implements UserService
{      
    /**
     *
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    public function getUserRepository()
    {
        return $this->userRepository;
    }

    public function setUserRepository(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        return $this;
    }

    public function add(User $user)
    {
        $this->userRepository->add($user);
    }

    public function delete(User $user)
    {

    }

    public function findById($id)
    {

    }

    public function save(User $user)
    {
    }

    public function update(User $user)
    {

    }
    
    public function getAuthenticationService() 
    {
        $authenticationAdapter = $this->userRepository->getAuthenticationAdapter();
        return new \Zend\Authentication\AuthenticationService(null, $authenticationAdapter);
    }

    public function login($email, $password) 
    {
        $authenticationService = $this->getAuthenticationService();
        
        /**
         * @var \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter $authenticationAdapter
         */
        $authenticationAdapter = $authenticationService->getAdapter();
        $authenticationAdapter->setIdentity($email);
        $authenticationAdapter->setCredential($password);
        
        $result = $authenticationAdapter->authenticate();
        
        if ($result->isValid()) {
            $identityObject = $authenticationAdapter->getResultRowObject(null, array('password'));
            $authenticationService->getStorage()->write($identityObject); // writes into the user's session.
        }
        
        return false;                    
    }

}
