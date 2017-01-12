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

namespace JustPublish\Helper;

use JustPublish\Registry;

class JpTemplateHelper
{
    protected $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function includeController($controller, $method, $parameters = array())
    {
        $controller = $this->registry->router->getController($controller);

        $controller->$method();

        return $this->registry->content;
    }

    public function includeTemplate($template, $parameters = array())
    {
        $this->registry->template->render($template);

        return $this->registry->content;
    }
}
