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

class Router
{
    private $registry;
    private $controllerNs;

    public function __construct(Registry $registry, $controllerNs = null)
    {
        $this->registry = $registry;

        if (null !== $controllerNs) {
            $this->setPath($controllerNs);
        }

        return $this;
    }

    /**
     * Set namespace for controllers
     * 
     * @param  string $controllerNs
     * 
     * @return Router
     */
    public function setPath($controllerNs)
    {
        $this->controllerNs = $controllerNs;

        return $this;
    }

    /**
     * Determinate route and calls controller
     */
    public function handleRoute()
    {
        $route = $this->getRoute();

        $controller = $this->getController($route[0]);

        if (false === isset($route[1]) && is_callable(array($controller, 'index'))) {
            $controller->index();

            return;
        }

        if (isset($route[1]) && is_callable(array($controller, $route[1]))) {
            $controller->{$route[1]}($this->registry->request);
    
            return;
        }

        $this->foward404();
    }

    /**
     * Returns controller for requested route
     * 
     * @param  string $controller
     * 
     * @return JustPublish\Core\Controller\ControllerInterface
     */
    public function getController($controller)
    {
        $cls = $this->controllerNs.'\\'.ucfirst($controller);

        if (false === class_exists($cls)) {
            $this->foward404();
        }

        return new $cls($this->registry);
    }

    /**
     * Splits requested route into controller and method
     * 
     * @return array
     */
    public function getRoute()
    {
        $route = substr($this->registry->request->get('path'), 1);
        $route = 0 !== strlen($route) ? $route : INDEX;
        $route = explode('/', $route);

        return $route;
    }

    /**
     * Sets template 404.php and exits
     */
    public function foward404()
    {
        $this->registry->template->render('404');
        
        exit($this->registry->content);
    }
}