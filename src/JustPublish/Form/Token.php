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

use JustPublish\Storage\SessionManager;

class Token
{
    const TOKEN_NAME = 'TOKEN';

    private $session;

    /**
     * @param SessionManager $session
     */
    public function __construct(SessionManager $sessionManager)
    {
        $this->storage = $sessionManager;
    }

    /**
     * Generates a new token and stores it
     */
    public function generate()
    {
        $this->storage->set(self::TOKEN_NAME, md5(uniqid()));
    }

    /**
     * Validates a given token to the one in storage
     * 
     * @param  string $token
     * @return bool
     */
    public function validate($token)
    {
        if ($this->storage->get(self::TOKEN_NAME) !== $token) {
            return false;
        }

        $this->storage->delete(self::TOKEN_NAME);

        return true;
    }
}