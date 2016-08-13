<?php
namespace User\InputFilter;

use Zend\InputFilter\InputFilter;

/**
 * Description of Login
 *
 * @author the_admin
 */
class Login extends InputFilter
{
    
    public function __construct() 
    {
        $email = new Input('email');
        $email->setRequired(true);
        $email->setValidatorChain($this->getEmailValidatorChain());
        $email->setFilterChain($this->getStringTrimFilterChain());
        
        $password = new Input('password');
        $password->setRequired(true);
        $password->setFilterChain($this->setStringTrimFilterChain());
        
        $this->add($email);
        $this->add($password);        
    }
    
    /**
     * Gets the validation chain for the email input
     * @return \Zend\Validator\ValidatorChain
     */
    protected function getEmailValidatorChain()
    {
       $stringLength = new Validator\StringLength(); 
       $stringLength->setMin(2);
       $stringLength->setMax(50);
       
       $validatorChain = new \Zend\Validator\ValidatorChain();
       $validatorChain->attach($stringLength, true);
       $validatorChain->attach(new Validator\EmailAddress(), true);
       
       return $validatorChain;            
    }
    
    
    protected function getStringTrimFilterChain()
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());
    }
}
