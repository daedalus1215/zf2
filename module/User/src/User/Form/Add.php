<?php
namespace User\Form;

use User\Entity\Hydrator\UserHydrator;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Hydrator\Aggregate\AggregateHydrator;

/**
 * Description of Add
 *
 * @author ladams
 */
class Add extends Form
{

    public function __construct()
    {
        parent::__construct('add'); // pass in the name of the form.

        $hydrator = new AggregateHydrator();
        $hydrator->add(new UserHydrator());
        $this->setHydrator($hydrator);


        $firstName = new Text('first_name');
        $firstName->setLabel('First Name');
        $firstName->setAttribute('class', 'form-control');

        $lastName = new Text('last_name');
        $lastName->setLabel('Last Name');
        $lastName->setAttribute('class', 'form-control');

        $email = new Email('email');
        $email->setLabel('Email Address');
        $email->setAttribute('class', 'form-control');

        $password = new Password('password');
        $password->setLabel('Password');
        $password->setAttribute('class', 'form-control');

        $repeatPassword = new Password('repeat_password');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->setAttribute('class', 'form-control');

        $submit = new Submit('submit');
        $submit->setValue('Add User');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($firstName);
        $this->add($lastName);
        $this->add($password);
        $this->add($email);
        $this->add($repeatPassword);
        $this->add($submit);
    }

}
