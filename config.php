<?php

/*
 * debug
 * Levels:
 * NONE = 0
 * E_ERROR = 1
 * E_WARNING = 2
 * E_PARSE = 4
 * E_NOTICE = 8
 * E_ALL = -1
 *
 * use "0" in prod
 */
define('DEBUG_LEVEL', -1);

// database config
define('DB_NAME', 'just_publish');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_TABLE_PREFIX', 'jp_');

// view config
define('LAYOUT', 'layout');
define('THEME', 'default');
define('FALLBACK_THEME', 'default');

// session
define('SESSION_TIME', 30);

// blog config
// define('POSTS')

// move to another file later
// leave unchanged
define('ROOT', __DIR__);