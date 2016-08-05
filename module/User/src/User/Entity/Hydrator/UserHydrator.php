<?php
namespace User\Entity\Hydrator;

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
        $object->setId(isset($data['id'])?:null);
        $object->setFirstName(isset($data['firstName'])?:null);
        $object->setLastName(isset($data['lastName'])?:null);
        $object->setUsername(isset($data['username'])?:null);
        $object->setEmail(isset($data['email'])?:null);
        $object->setCreatedDate(isset($data['createdDate'])?:null);
        $object->setUserGroup(isset($data['userGroup'])?:null);
        $object->setAuthorId(isset($data['authorId'])?:null);
        return $object;
    }

//put your code here
}
