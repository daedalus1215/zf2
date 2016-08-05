<?php

namespace User\Service;

use User\Entity\User;

/**
 * Description of UserService
 *
 * @author ladams
 */
interface UserService
{
    /**
     *
     * @param User $user
     */
    public function save(User $user);
    /**
     *
     * @param int $id
     */
    public function findById($id);
    /**
     *
     * @param User $user
     */
    public function update(User $user);
    /**
     *
     * @param User $user
     */
    public function delete(User $user);
}
