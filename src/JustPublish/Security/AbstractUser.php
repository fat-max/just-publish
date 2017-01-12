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

namespace JustPublish\Security;

abstract class AbstractUser
{
    protected $role;
    protected $authenticated = null;

    public function signIn()
    {
        
    }

    public function signOut()
    {

    }

    public function setPassword($password)
    {

    }
}