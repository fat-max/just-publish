<?php

/*
 * This file is part of App.
 *
 * (c) Max L <qwerty@fatmax.se>
 * 
 * This work is free. You can redistribute it and/or modify it under the
 * terms of the Do What The Fuck You Want To Public License, Version 2,
 * as published by Sam Hocevar. See http://www.wtfpl.net/ for more details.
 */

namespace App\Controller;

use JustPublish\Controller\AbstractController;
use App\Query\PostQuery;
use JustPublish\Request\Request;
use JustPublish\Form\Form;

class Admin extends AbstractController
{

    public function index()
    {
        $form = new Form();

        $form
            ->addField('title', array(
                'type' => 'text',
                'label' => 'Title',
            ))
            ->addField('content', array(
                'type' => 'textarea',
                'label' => 'Content',
            ))
        ;

        // $this->render('index');
    }

    public function login()
    {
        $this->form = new Form();

        $this->form
            ->addField('username', array(
                'type' => 'text',
                'label' => 'Username',
            ))
            ->addField('password', array(
                'type' => 'password',
                'label' => 'Password',
            ))
        ;

        $this->render('login');
    }

    public function logout()
    {
        $this->render('index');
    }
}