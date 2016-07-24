<?php
namespace Blog\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Add extends Form
{
    public function __construct()
    {
        parent::__construct('add'); // pass in the name of our form.
        // mapping form element names to variable names to the target object.
        $this->setHydrator(new ClassMethods()); // a hydrator is essentially an object that populates another object, based off of a set of data.

        // need an element for each field for our form.
        $title = new Element\Text('title');
        $title->setLabel('Title');
        //can add some - there are better ways of doing this.
        $title->setAttribute('class', 'form-control');

        $slug = new Element\Text('slug');
        $slug->setLabel('Slug');
        $slug->setAttribute('class', 'form-control');

        $content = new Element\Textarea('content');
        $content->setLabel('Content');
        $content->setAttribute('class', 'form-control');

        $category = new Element\Select('category');
        $category->setLabel('Category');
        $category->setAttribute('class', 'form-control');
        $category->setValueOptions(array(
            1 => 'PHP',
            2 => 'Zend Framework',
            3 => 'MySQL'
        ));

        //create submit button.
        $submit = new Element\Submit('submit');
        $submit->setValue('Add Post');
        $submit->setAttribute('class', 'btn btn-primary');

        //add the elements to this form.
        $this->add($title);
        $this->add($slug);
        $this->add($content);
        $this->add($category);
        $this->add($submit);
    }
}