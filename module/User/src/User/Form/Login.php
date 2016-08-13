<?php
namespace User\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author the_admin
 */
class Login extends Form
{
    public function __construct() 
    {
        parent::__construct('login');
        
        $username = new Email('email');
        $username->setLabel("Email");
        $username->setAttribute(['class' => 'form-control']);
        
        $password = new Pasword('password');
        $password->setLabel('Password');
        $password->setAttribute(['class' => 'form-control']);
        
        $submit = new Submit('submit');
        $submit->setLabel('Login');
        $submit->setAttribute('class', 'btn btn-primary');
        
        $this->add($username);
        $this->add($password);
        $this->add($submit);
    }
}
