<?php

class Application
{
    static function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        /*
        $uri =  explode('/', $uri);

        foreach ($uri as $key => $value) {
            echo "<p>{$value}</p>";
        }

        die();
        */

        /*
         * HomeController will be responsable 
         * for '/' route, so if $uri is '/', 
         * the value of $uri will be 'Home'.
        */
        if ($uri == '/') {
            $uri = 'Home';

        /* 
         * if $uri isn't '/', the code 
         * will continue to validate 
         * a possible other controller. 
         */
        } else {
            // here we'll separate url, like /abc/def/ghi in an array.
            $uri = explode('/', $uri);
            
            // here we got the first position, that must be the controller.
            $uri = $uri[1];

            // all letters to lower case
            $uri = strtolower($uri);

            // first letter to upper case
            $uri = ucfirst($uri);
        }

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
            // this line has the path of 404 user file.
            $path_of_file_of_404 = '../Views/errors/404.php';

            /*
             * here we'll validate if 
             * the user of this code 
             * has create his own 404 file. 
             * if not, it'll get the default path.
             */
            if (!file_exists($path_of_file_of_404)) {
                $path_of_file_of_404 = '../Views/default_files/errors/404.php';
            }
            
            // validate if the default file exist.
            if (!file_exists($path_of_file_of_404)) {
                /*
                 * if the default file doesn't 
                 * exists, a die() with a 
                 * message will be executed. 
                 */
                die('<h1>Default file not found!</h1>');
            }

            /*
             * if user file exists or the default file, it'll be load. 
             */
            require_once $path_of_file_of_404;
        } 
    }
}
