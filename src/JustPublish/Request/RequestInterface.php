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

namespace JustPublish\Request;

interface RequestInterface
{
    /**
     * Return request parameters
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Return request parameters
     * @param string $key
     * @param mixed
     * @return mixed
     */
    public function getParameter($key, $default = null);

    /**
     * Compare method type with expected
     * @param  string $method
     * @return bool
     */
    public function isMethod($method);

    /**
     * Return requst method
     * @param  string $method
     * @return string
     */
    public function getMethod();
}