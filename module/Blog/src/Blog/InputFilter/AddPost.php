<?php

namespace Blog\InputFilter;

use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;


/**
 * Description of AddPost
 *
 * @author ladams
 */
class AddPost extends InputFilter
{
    public function __construct()
    {
        $title = new Input('title');
        $title->setRequired(true); // make sure the title element is required.
        $title->setValidatorChain($this->getTitleValidatorChain());
        $title->setFilterChain($this->getStringTrimFilterChain());

        $slug = new Input('slug');
        $slug->setRequired(true);
        $slug->setValidatorChain($this->getSlugValidatorChain());
        $slug->setFilterChain($this->getStringTrimFilterChain());

        $content = new Input('content');
        $content->setRequired(true);
        $content->setValidatorChain($this->getContentValidatorChain());
        $content->setFilterChain($this->getStringTrimFilterChain());

        $this->add($title);
        $this->add($slug);
        $this->add($content);
    }



    protected function getTitleValidatorChain()
    {
        $strLengthValidator = new StringLength();
        $strLengthValidator->setMin(5);
        $strLengthValidator->setMax(50);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($strLengthValidator);

        return $validatorChain;
    }

    protected function getSlugValidatorChain()
    {
        $strLength = new StringLength();
        $strLength->setMin(5);
        $strLength->setMax(50);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($strLength);

        return $validatorChain;
    }

    protected function getContentValidatorChain()
    {
        $strlen = new StringLength();
        $strlen->setMin(10);

        $validChain = new ValidatorChain();
        $validChain->attach($strlen);

        return $validChain;
    }

    protected function getStringTrimFilterChain()
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());

        return $filterChain;
    }
}
