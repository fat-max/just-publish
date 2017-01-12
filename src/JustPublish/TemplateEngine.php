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
use JustPublish\Helper\JpTemplateHelper;

class TemplateEngine
{
    protected $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function render($template = null, $useLayout = true)
    {
        $template = ROOT.'/View/'.THEME.'/'.$template.'.php';

        $this->registry->useLayout = $useLayout;

        if (false === file_exists($template)) {
            throw new \Exception(sprintf('Template "%s" was not found.', $template));
        }

        if (is_array($this->registry->templateVars)) {
            foreach ($this->registry->templateVars as $key => $value) {
                $$key = $value;
            }
        }

        $helper = new JpTemplateHelper($this->registry);

        ob_start();
        include $template;
        $this->registry->content = ob_get_contents();
        ob_end_clean();
    }
}