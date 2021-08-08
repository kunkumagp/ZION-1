<?php

namespace app\core;

/*
* @author     Kunkuma Geeth Prasanna <kunkumagp@gmail.com>
* @package    app\core
*/

class Router  
{
    public Request $request;
    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        echo $path;
    }
}
