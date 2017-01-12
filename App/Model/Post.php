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

namespace App\Model;

class Post
{
    public $id;
    public $user;
    public $title;
    public $content;
    public $disabled;
    public $publishTime;
    public $createdAt;
}