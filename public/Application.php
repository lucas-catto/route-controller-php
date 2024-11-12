<?php

class Application
{
    static function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // delete '/' of /page
        $uri = substr($uri, 1);

        // all letters to lower case
        $uri = strtolower($uri);

        // first letter to upper case
        $uri = ucfirst($uri);
        
        // if uri is Home, it'll be HomeController
        $controller = $uri.'Controller';

        // then it'll be HomeController.php
        $controller_file = $controller.'.php';

        /*
         * here we'll create the possible controller 
         * path to verify if it exists.
         * Example: Controllers/HomeController.php
         */
        $controller_path = '../Controllers/'.$controller_file;

        // verify if controller exists.
        if (file_exists($controller_path)) {
            
            /*
             * if exists, based on path, will include the file.
             */
            require_once $controller_path;

            // here we'll create an instance.
            $controller_instance = new $controller;

        /*
         * if we got here, it's because the controller doesn't exists.
         */
        } else {
            echo 'false';
        }
    }
}
