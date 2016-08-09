<?php
namespace User\Repository;

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
}
