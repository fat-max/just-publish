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

namespace JustPublish\Storage;

class SessionManager
{
    public function __construct()
    {
        if ('' === session_id()) {
            session_start();
        }

        $this->checkAge();

        return $this;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function destroy()
    {
        if ('' === session_id()) {
            return;
        }

        $_SESSION = array();
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }

    public function checkAge()
    {
        if (
            isset($_SESSION['LAST_ACTIVITY']) && 
            (time() - $_SESSION['LAST_ACTIVITY'] > SESSION_TIME)
        ) {
            $this->destroy();
        }

        $_SESSION['LAST_ACTIVITY'] = time();

        if (
            isset($_SESSION['CREATED']) && 
            (time() - $_SESSION['CREATED'] > SESSION_TIME)
        ) {
            session_regenerate_id(true);
        }
        
        $_SESSION['CREATED'] = time();
    }
}