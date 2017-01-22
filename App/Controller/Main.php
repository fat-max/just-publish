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

class Main extends AbstractController
{
    public function index()
    {
        $this->render('index');
    }

    public function posts()
    {
        $this->posts = PostQuery::create()
            ->joinComments()
            ->joinUser()
            ->addField('count(jp_comments.id) as comments')
            ->addField('jp_user.full_name as user')
            ->groupBy('jp_post.id')
            ->orderBy(array('jp_post.publish_time', 'jp_post.created_at'), 'DESC')
            ->find()
        ;

        $this->render('posts', false);
    }

    public function post(Request $request)
    {
        $this->posts = PostQuery::create()
            ->joinComments()
            ->joinUser()
            ->filterBy('jp_post.id', $request->getParameter('id'))
            ->find()
        ;

        $this->render('post');
    }
}