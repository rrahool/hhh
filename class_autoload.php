<?php
session_start();

function loadClass($class_name)
{

        $parts = explode('\\', $class_name);
        require 'classes/'.end($parts) . '.php';

}

spl_autoload_register("loadClass");
