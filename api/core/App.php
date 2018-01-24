<?php
/**
 * Created by root
 * Date: 1/22/18
 * Time: 5:11 AM
 */

class App
{
    protected $controller = 'agent';

    protected $method = 'index';

    protected $formdata = '';

    function __construct(){
        $url = $this->parseUrl();

        if(file_exists("../api/".$url[0].".php"))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }
        $this->controller = $url[0];
        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        if(isset($url[2]))
        {
            $this->formdata = $url[2];
            unset($url[2]);
            $method = $this->method;
            $controller = $this->controller;
            $controller->$method($this->formdata);
        }else {
            $method = $this->method;
            $controller = $this->controller;
            $controller->$method();
        }

    }

    public function parseUrl(){
        if(isset($_GET['url']))
        {
            return $url = explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
        }
    }
}