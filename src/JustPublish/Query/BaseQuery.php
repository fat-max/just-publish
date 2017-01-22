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

use JustPublish\Db\DbHandler;
use JustPublish\Query\QueryInterface;

class BaseQuery extends DbHandler implements QueryInterface
{
    /**
     * @var string
     */
    protected $sql;

    /**
     * @var string[]
     */
    protected $fields = array();

    /**
     * @var string
     */
    protected $nextCondition = 'AND';

    /**
     * @var string
     */
    protected $conditions = '';

    /**
     * @var string[]
     */
    protected $joins = array();

    /**
     * @var string
     */
    protected $order;

    /**
     * @var string[]
     */
    protected $orderFields = array();

    /**
     * @var string[]
     */
    protected $group = array();

    /**
     * @inheritDoc
     */
    public function filterBy($field, $value, $operator = '=')
    {
        $this->conditions .= sprintf(
            ' %s %s %s %s', 
            $this->nextCondition, 
            $field, 
            $operator, 
            is_numeric($value) ? $value : "'$value'"
        );

        $this->nextCondition = 'AND';

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function _or()
    {
        $this->nextCondition = 'OR';

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function selectFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Replace default fields to be selected
     * 
     * @param  string field
     * 
     * @return QueryInterface
     */
    public function addField($field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function orderBy($fields, $order = 'ASC')
    {
        if (!is_array($fields)) {
            $fields = array($fields);
        }

        $this->orderFields = $fields;
        $this->order = $order;

        return $this;
    }

    /**
     * Group by field(s)
     * 
     * @param  string|array $fields
     * 
     * @return QueryInterface
     */
    public function groupBy($fields)
    {
        if (!is_array($fields)) {
            $fields = array($fields);
        }

        $this->group = $fields;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function limit($number)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function find()
    {
        return $this->query($this->getSql());
    }

    /**
     * Execute query
     *
     * @param  int $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->query($this->filterBy('id', $id)->getSql());
    }

    /**
     * Build complete query
     * 
     * @return string
     */
    private function getSql()
    {
        $order = empty($this->orderFields) ?
            null : 'ORDER BY '.implode(', ', $this->orderFields).' '.$this->order;

        $group = empty($this->group) ?
            null : 'GROUP BY '.implode(', ', $this->group);

        return str_replace(
            array(
                '%fields%', 
                '%joins%',
                '%conditions%',
                '%order%',
                '%groups%',
            ), 
            array(
                implode(', ',$this->fields), 
                implode(' ',$this->joins), 
                $this->conditions, 
                $order, 
                $group, 
            ), 
            $this->sql
        );
    }

    /**
     * Return query
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getSql();
    }
}