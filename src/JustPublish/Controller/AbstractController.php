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

namespace JustPublish\Controller;

use JustPublish\Controller\ControllerInterface;
use JustPublish\Registry;

abstract class AbstractController implements ControllerInterface
{
    protected $registry;
    protected $vars = array();

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function __set($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function __get($key)
    {
        return $this->vars[$key];
    }

    public function render($template = null, $useLayout = true)
    {
        $this->registry->templateVars = $this->vars;
        $this->registry->template->render($template, $useLayout);
    }

    abstract function index();
}