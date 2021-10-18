<?php

spl_autoload_register('autoload');


function autoload($class)
{  
    //require_once str_replace('SocialAuther/', '', str_replace('\\', '/', $class) . '.php');
  //  include_once str_replace(get_stylesheet_directory().'/inc/plugin/SocialAuther/', '', str_replace('\\', '/', $class) . '.php');
  require_once get_stylesheet_directory() . '/inc/plugin/SocialAuther/' .str_replace('SocialAuther/', '', str_replace('\\', '/', $class) . '.php');

}