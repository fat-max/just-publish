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

use JustPublish\Registry;
use JustPublish\Router;
use JustPublish\Request\Request;
use JustPublish\TemplateEngine;
use JustPublish\Db\DbHandler;
use JustPublish\Storage\SessionManager;

/**
 * 
 */
class Kernel
{
    private $registry;

    public function __construct($path = null)
    {
        $this->registry = new Registry;
        $this->registry->dbHandler = new DbHandler;
        $this->registry->router = new Router($this->registry, $path);
        $this->registry->request = new Request;
        $this->registry->template = new TemplateEngine($this->registry);
        $this->registry->session = new SessionManager;
    }

    public function run()
    {
        $this->registry->router->handleRoute();
    }

    public function terminate()
    {
        $layout = ROOT.'/View/'.LAYOUT.'.php';

        if (false === file_exists($layout)) {
            throw new \Exception(sprintf('Layout "%s" was not found', $layout));
        }

        foreach ($this->registry->vars as $key => $value) {
            $$key = $value;
        }

        if (false === $this->registry->useLayout) {
            echo $this->registry->content;

            return;
        }

        include $layout;
    }
}