<?php

namespace User\Repository;

/**
 * Description of UserRepositoryImpl
 *
 * @author ladams
 */
class UserRepositoryImpl implements UserRepository
{

    public function add(User $user)
    {
        $sql = new Sql\Sql($this->adapter);
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

        $statement = $sql->prepareForSqlObject($insert);
        $statement->execute();
    }

    public function generatePasswords($clearTextPassword)
    {
        $encrypter = new Bcrypt();
        $encrypter->setCost(12);

        return $encrypter->create($clearTextPassword);
    }

    public function setDbAdapter(\Zend\Db\Adapter\Adapter $adapter)
    {

    }

}