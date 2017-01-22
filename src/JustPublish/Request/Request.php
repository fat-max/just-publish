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

use JustPublish\Request\RequestInterface;

class Request implements RequestInterface
{
    private $parameters;
    private $method;

    public function __construct()
    {
        $this->parameters = $this->cleanParams();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Format parameters
     * @return array
     */
    private function cleanParams()
    {
        $params = parse_url(sprintf('//%s%s', $_SERVER[HTTP_HOST], $_SERVER[REQUEST_URI]));
        $params['query'] = array_merge($_GET, $_POST);

        return $params;
    }

    /**
     * @inheritDoc
     */
    public function get($key)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    /**
     * @inheritDoc
     */
    public function getParameter($key, $default = null)
    {
        return isset($this->parameters['query'][$key]) ? $this->parameters['query'][$key] : $default;
    }

    /**
     * @inheritDoc
     */
    public function isMethod($method)
    {
        return $this->method == strtoupper($method) ? true : false;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return $this->method;
    }
}