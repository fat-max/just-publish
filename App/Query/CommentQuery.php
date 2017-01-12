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

namespace App\Query;

use JustPublish\Db\DbHandler;
use JustPublish\Query\BaseQuery;

class CommentQuery extends BaseQuery
{
    /**
     * @var string
     */
    protected $sql = 'SELECT %fields% FROM jp_comment %joins% WHERE 1 = 1';

    /**
     * @var string[]
     */
    protected $fields = array(
        'id',
        'post_id',
        'comment_id',
        'name',
        'homepage',
        'content',
        'created_at',
    );

    /**
     * Create new instance of it self
     * 
     * @return PostQuery
     */
    public static function create()
    {
        return new CommentQuery;
    }
}