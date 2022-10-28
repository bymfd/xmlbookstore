<?php


function custom_autoloader($class) {
    include __DIR__.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR . $class . '.php';
  }
   
spl_autoload_register('custom_autoloader');