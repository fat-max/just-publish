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

namespace JustPublish\Db;

class DbHandler
{
    protected $pdo;
    protected $query;
    protected $results;
    protected $count;

    public function __construct()
    {
        $connectString = sprintf(
            'mysql:host=%s;dbname=%s;',
            DB_HOST,
            DB_NAME
        );
        
        $this->pdo = new \PDO($connectString, DB_USER, DB_PASSWORD);

        return $this;
    }

    public function query($query, $object = null)
    {
        $query = $this->pdo->query($query);
        
        if (false === $query) {
            return;
        }

        if (null !== $object) {
            $query->setFetchMode(\PDO::FETCH_CLASS, $object);
        } else {
            $query->setFetchMode(\PDO::FETCH_OBJ);
        }

        return $query->fetchAll();
    }

    public function query2($sql, $paramas = [], $object = null)
    {
        $this->count = 0;

        if (false === ($this->query = $this->pdo->prepare($sql))) {
            return;
        }

        foreach ($params as $key => $param) {
            $this->query->bindValue($key + 1, $param);
        }

        if (false === $this->query->execute()) {
            return;
        }

        if (null !== $object) {
            $qthis->uery->setFetchMode(\PDO::FETCH_CLASS, $object);
        } else {
            $this->query->setFetchMode(\PDO::FETCH_OBJ);
        }

        $this->results = $this->query->fetchAll();
        $this->count = $this->query->rowCount();

        return $this;
    }

    private function action()
    {

    }

    public function get()
    {

    }

    public function results()
    {
        return $this->results;
    }

    public function delete()
    {
        
    }

    public function insert()
    {

    }

    public function count()
    {
        return $this->count;
    }
}