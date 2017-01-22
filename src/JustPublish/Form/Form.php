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

namespace JustPublish\Form;

use JustPublish\Form\Validation;
use JustPublish\Request\RequestInterface;

class Form
{
    private $validator;
    private $fields = array();

    public function __construct()
    {
        $this->validator = new Validation();
        // $this->fields['token'] = ;
    }

    public function addField($field, $params)
    {
        switch ($params['type']) {
            case 'textarea':
                $input = sprintf(
                    '<textarea name="%s" id="%s">%s</textarea>', 
                    $field, 
                    $field.'-form', 
                    isset($params['value']) ? $params['value'] : null
                );
                break;
            default:
                $input = sprintf(
                    '<input type="%s" name="%s"  id="%s">%s</textarea>', 
                    isset($params['type']) ? $params['type'] : 'text',
                    $field, 
                    $field.'-form',
                    isset($params['value'])
                );
        }

        $this->fields[$field] = array(
            'input' => $input, 
            'label' => isset($params['label']) ? $params['label'] : $field,
        );
        
        return $this;
    }

    // pubilc function bind(RequestInterface $request);

    public function __toString()
    {
        $str = '';
        foreach ($this->fields as $name => $field) {
            $str .= sprintf(
                '<label for="%s">%s</label>%s', 
                $name.'-form', 
                $field['label'], 
                $field['input']
            );
        }

        return $str;
    }
}