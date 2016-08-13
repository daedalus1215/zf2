<?php
namespace User\Repository;

use Application\Repository\RepositoryInterface;
use User\Entity\User;

/**
 * Description of UserRepository
 *
 * @author ladams
 */
interface UserRepository extends RepositoryInterface
{

    /**
     *
     * @param User $user
     */
    public function add(User $user);
    /**
     *
     * @param type $clearTextPassword
     */
    public function generatePasswords($clearTextPassword);
    
    /**
     * @return \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter
     */
    public function getAuthenticationAdapter();            
}
