<?php
/**
 * Created by PhpStorm.
 * User: Raphson
 * Date: 4/9/16
 * Time: 23:42
 */

function isSecure() {
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
}