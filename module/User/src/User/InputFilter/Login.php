<?php
namespace User\InputFilter;

use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;


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
        $password->setFilterChain($this->getStringTrimFilterChain());
        
        $this->add($email);
        $this->add($password);        
    }
    
    /**
     * Gets the validation chain for the email input
     * @return ValidatorChain
     */
    protected function getEmailValidatorChain()
    {
       $stringLength = new StringLength(); 
       $stringLength->setMin(2);
       $stringLength->setMax(50);
       
       $validatorChain = new ValidatorChain();
       $validatorChain->attach($stringLength, true);
       $validatorChain->attach(new EmailAddress(), true);
       
       return $validatorChain;            
    }
    
    /**
     * 
     * @return \User\InputFilter\FilterChain
     */
    protected function getStringTrimFilterChain()
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());
        
        return $filterChain;
    }
}
