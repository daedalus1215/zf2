<?php
namespace User\Service;

use User\Entity\User;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserService
 *
 * @author ladams
 */
interface UserService
{
    const GROUP_REGULAR = 1;

    /**
     * @param User $user
     * @return
     */
    public function add(User $user);
}
