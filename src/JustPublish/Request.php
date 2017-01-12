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

class Request
{
    private $params;
    private $method;

    public function __construct()
    {
        $this->params = $this->cleanParams();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    private function cleanParams()
    {
        $params = array_merge($_GET, $_POST);

        if (!isset($params['route'])) {
            $params['route'] = 'main/index';
        }

        return $params;
    }

    public function get($key)
    {
        return isset($this->params[$key]) ? $this->params[$key] : null;
    }

    /**
     * Compare method type with expected
     * @param  string $method
     * @return bool
     */
    public function method($method)
    {
        return $this->method == strtoupper($method) ? true : false;
    }

    /**
     * Return requst method
     * @param  string $method
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}