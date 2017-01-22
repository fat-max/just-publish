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

namespace JustPublish\Query;

interface QueryInterface
{

    /**
     * Adds a condition to query
     * 
     * @param  string $field
     * @param  mixed $value
     * @param  string $operator
     * 
     * @return QueryInterface
     */
    public function filterBy($field, $value, $operator = '=');

    /**
     * Sets next condition to be an OR
     * 
     * @return QueryInterface
     */
    public function _or();

    /**
     * Replace default fields to be selected
     * 
     * @param  array  $fields
     * 
     * @return QueryInterface
     */
    public function selectFields(array $fields);

    /**
     * Order by field(s)
     * 
     * @param  string|array $fields
     * @param  string $order Defaul ASC
     * 
     * @return QueryInterface
     */
    public function orderBy($fields, $order = 'ASC');

    /**
     * Replace default fields to be selected
     * 
     * @param  int  $number
     * 
     * @return QueryInterface
     */
    public function limit($number);

    /**
     * @return mixed
     */
    public function find();

    /**
     * Return sql
     * @return string
     */
    public function __toString();
}