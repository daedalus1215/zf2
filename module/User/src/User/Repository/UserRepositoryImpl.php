<?php

namespace User\Repository;

use User\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Sql\Sql;

/**
 * Description of UserRepositoryImpl
 *
 * @author ladams
 */
class UserRepositoryImpl implements UserRepository
{
    use \Zend\Db\Adapter\AdapterAwareTrait;
    /**
     * 
     * @param User 
     * 
     */
    public function add(User $user)
    {
        $sql = new Sql($this->adapter);
        $insert = $sql->insert()
                ->values(array(
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'password' => $this->generatePasswords($user->getPassword()),
                    'created' => time(),
                    'user_group' => $user->getUserGroup(),
                ))
                ->into('user');

        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
    }

    public function generatePasswords($clearTextPassword)
    {
        $encrypter = new Bcrypt();
        $encrypter->setCost(12);

        return $encrypter->create($clearTextPassword);
    }
}
