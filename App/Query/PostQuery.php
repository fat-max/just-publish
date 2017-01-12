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

class PostQuery extends BaseQuery
{
    /**
     * @var string
     */
    protected $sql = 'SELECT %fields% FROM jp_post %joins% WHERE 1 = 1 %conditions% %groups% %order%';

    /**
     * @var string[]
     */
    protected $fields = array(
        'jp_post.id',
        'jp_post.user_id',
        'jp_post.title',
        'jp_post.content',
        'jp_post.disabled',
        'jp_post.publish_time',
        'jp_post.created_at',
    );

    /**
     * Create new instance of it self
     * 
     * @return PostQuery
     */
    public static function create()
    {
        return new PostQuery;
    }

    public function joinComments($join = 'LEFT')
    {
        $this->joins[] = sprintf(
            '%s JOIN jp_comments ON jp_comments.post_id=jp_post.id', 
            $join
        );

        $this->fields[] = 'jp_comments.*';

        return $this;
    }

    public function joinUser($join = 'LEFT')
    {
        $this->joins[] = sprintf(
            '%s JOIN jp_user ON jp_user.id=jp_post.user_id', 
            $join
        );

        $this->fields[] = 'jp_user.*';

        return $this;
    }
}