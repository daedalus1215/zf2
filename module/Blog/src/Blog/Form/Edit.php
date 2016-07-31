<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Form;

use Blog\Entity\Hydrator\CategoryHydrator;
use Blog\Entity\Hydrator\PostHydrator;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

/**
 * Description of Edit
 *
 * @author ladams
 */
class Edit extends Form
{

    public function __construct()
    {
        parent::__construct('add'); // pass in the name of our form.


        // mapping form element names to variable names to the target object.
        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());
        $this->setHydrator($hydrator);

        $id = new Hidden('id');

        // need an element for each field for our form.
        $title = new Text('title');
        $title->setLabel('Title');
        //can add some - there are better ways of doing this.
        $title->setAttribute('class', 'form-control');

        $slug = new Text('slug');
        $slug->setLabel('Slug');
        $slug->setAttribute('class', 'form-control');

        $content = new Textarea('content');
        $content->setLabel('Content');
        $content->setAttribute('class', 'form-control');

        $category = new Select('category');
        $category->setLabel('Category');
        $category->setAttribute('class', 'form-control');
        $category->setValueOptions(array(
            1 => 'PHP',
            2 => 'Zend Framework',
            3 => 'MySQL'
        ));

        //create submit button.
        $submit = new Submit('submit');
        $submit->setValue('Add Post');
        $submit->setAttribute('class', 'btn btn-primary');

        //add the elements to this form.
        $this->add($id);
        $this->add($title);
        $this->add($slug);
        $this->add($content);
        $this->add($category);
        $this->add($submit);
    }
}