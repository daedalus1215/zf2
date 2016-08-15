<?php
namespace User\Entity\Hydrator;

use User\Entity\User;
use Zend\Hydrator\HydratorInterface;
/**
 * Description of UserHydrator
 *
 * @author ladams
 */
class UserHydrator implements HydratorInterface
{
    public function extract($object)
    {
        if (!$object instanceof User) {
            return array();
        }

        return array (
            'id'        => $object->getId(),
            'firstName' => $object->getFirstName(),
            'lastName'  => $object->getLastName(),
            'username'  => $object->getUsername(),
            'email'     => $object->getEmail(),
            'password'  => $object->getPassword(),
            'createdDate' => $object->getCreatedDate(),
            'userGroup'   => $object->getUserGroup(),
            'authorId'    => $object->getAuthorId(),
        );
    }

    public function hydrate(array $data, $object)
    {
        if (!$object instanceof User) {
            return $object;
        }
        /**
         * @var User $object
         */
        $object->setId(isset($data['id']) ? $data['id'] : null);
        $object->setFirstName(isset($data['firstName']) ? $data['firstName'] :null);
        $object->setLastName(isset($data['lastName']) ? $data['lastName'] : null);
        $object->setUsername(isset($data['username']) ? $data['username'] : null);
        $object->setPassword(isset($data['password']) ? $data['password'] : null);
        $object->setEmail(isset($data['email']) ? $data['email'] : null);
        $object->setCreatedDate(isset($data['createdDate']) ? $data['createdDate'] : null);
        $object->setUserGroup(isset($data['userGroup']) ? $data['userGroup'] : null);
        $object->setAuthorId(isset($data['authorId'])? $data['authorId'] : null);
        return $object;
    }

//put your code here
}
