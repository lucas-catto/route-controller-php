<?php

class Application
{
    static function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        echo $uri;
    }
}
