<?php 

/*
 * This file is part of JustPublish.
 *
 * (c) Max L <qwerty@fatmax.se>
 * 
 * This work is free. You can redistribute it and/or modify it under the
 * terms of the Do What The Fuck You Want To Public License, Version 2,
 * as published by Sam Hocevar. See http://www.wtfpl.net/ for more details.
 */

namespace JustPublish;

/**
 * Handle application variables.
 */
class Registry
{
    /**
     * @var array
     */
    public $vars = array();

    /**
     * @param string $key
     * 
     * @param mixed  $value
     */
    public function __set($key, $value)
    {
        $this->vars[$key] = $value;
    }

    /**
     * @param  string $key
     * 
     * @return mixed
     */
    public function __get($key)
    {
        return isset($this->vars[$key]) ? $this->vars[$key] : null;
    }
}