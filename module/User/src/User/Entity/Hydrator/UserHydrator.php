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
        $object->setId(isset($data)?:null);
        $object->setFirstName(isset($data)?:null);
        $object->setLastName(isset($data)?:null);
        $object->setUsername(isset($data)?:null);
        $object->setEmail(isset($data)?:null);

        return $object;
    }

//put your code here
}
