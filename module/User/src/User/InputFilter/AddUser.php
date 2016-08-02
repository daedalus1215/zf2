<?php
namespace User\InputFilter;

use Zend\Db\Adapter\Adapter;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
/**
 * Description of AddUser
 *
 * @author ladams
 */
class AddUser extends InputFilter
{
    /**
     *
     * @var InputFilter $dbAdapter
     */
    protected $dbAdapter;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;

        $firstName = new Input('firstName');
        $firstName->setRequired(true);
        $firstName->setValidatorChain($this->getNameValidatorChain());
        $firstName->setFilterChain($this->getStringTrimFilterChain());

        $lastName = new Input('lastName');
        $lastName->setRequired(true);
        $lastName->setValidatorChain($this->getNameValidatorChain());
        $lastName->setFilterChain($this->getStringTrimFilterChain());

        $email = new Input('email');
        $email->setRequired(true);
        $email->setValidatorChain($this->getNameValidatorChain());
        $email->setFilterChain($this->getStringTrimFilterChain());

        $password = new Input('password');
        $password->setRequired(true);
        $password->setValidatorChain($this->getNameValidatorChain());
        $password->setFilterChain($this->getStringTrimFilterChain());

        $repeatPassword = new Input('repeatPassword');
        $repeatPassword->setRequired(true);
        $repeatPassword->setValidatorChain($this->getNameValidatorChain());
        $repeatPassword->setFilterChain($this->getStringTrimFilterChain());


        $this->add($firstName);
        $this->add($lastName);
        $this->add($email);
        $this->add($password);
        $this->add($repeatPassword);



    }


    /**
     * Gets the validation chain for the first name and last name inputs
     * @return ValidatorChain
     */
    protected function getNameValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(2);
        $stringLength->setMax(50);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    /**
     * Gets the validation chain for the email input
     */
    protected function getStringTrimFilterChain()
    {

    }



}
