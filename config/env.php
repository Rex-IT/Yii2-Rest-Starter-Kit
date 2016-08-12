<?php
/**
 * Created by Rex IT.
 * rexit.web@gmail.com
 */

/**
 * Load application environment from .env file
 */
$dotEnv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotEnv->load();


/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = false) {
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
    }
    return $value;
}


defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));