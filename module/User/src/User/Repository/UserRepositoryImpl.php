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
    
    /**
     * 
     * @param type $clearTextPassword
     * @return type
     */
    public function generatePasswords($clearTextPassword)
    {
        $encrypter = new Bcrypt();
        $encrypter->setCost(12);
        $encryptedPassword = $encrypter->create($clearTextPassword);
        
        print ("The encrypted generatedPassword is : " . $encryptedPassword);
        
        return $encryptedPassword;
    }
    
    /**
     * 
     * @return \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter
     */
    public function getAuthenticationAdapter() 
    {
        // Where are we getting these two passwords.
        $callback = function($encryptedPassword, $clearTextedPassword) {
            $encrypter = new Bcrypt();
            $encrypter->setCost(12);
            print ("The encrypted password we are checking with getAUthentication is : " . $encryptedPassword);
            return $encrypter->verify($clearTextedPassword, $encryptedPassword);
        };
        
        $authenticationAdapter = new \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter(
                $this->adapter,
                'user', // Table
                'email', // Identity column 
                'password', // Credential column
                $callback
        );
        
        return $authenticationAdapter;
    }
}
