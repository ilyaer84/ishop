<?php

spl_autoload_register('autoload');

function autoload($class)
{
    require_once str_replace(__DIR__ . '/inc/plugin/SocialAuther/', '', str_replace('\\', '/', $class) . '.php');
}