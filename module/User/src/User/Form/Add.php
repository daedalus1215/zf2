<?php
namespace User\Form;

use Zend\Form\Form;

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

        $hydrator = new \Zend\Hydrator\Aggregate\AggregateHydrator();
        $hydrator->add(new UserHydrator());
        $this->setHydrator($hydrator);


        $firstName = new Element\Text('first_name');
        $firstName->setLabel('First Name');
        $firstName->setAttribute('class', 'form-control');

        $lastName = new Element\Text('last_name');
        $lastName->setLabel('Last Name');
        $lastName->setAttribute('class', 'form-control');

        $email = new Element\Email('email');
        $email->setLabel('Email Address');
        $email->setAttribute('class', 'form-control');

        $password = new Element\Password('password');
        $password->setLabel('Password');
        $password->setAttribute('class', 'form-control');

        $repeatPassword = new Element\Password('repeat_password');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->setAttribute('class', 'form-control');

        $submit = new Element\Submit('submit');
        $submit->setValue('Add User');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($firstName);
        $this->add($lastName);
        $this->add($password);
        $this->add($repeatPassword);
        $this->add($submit);
    }

}
