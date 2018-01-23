<?php
/**
 * Created by root
 * Date: 1/22/18
 * Time: 5:02 AM
 */

spl_autoload_register(function ($class){
    if(file_exists("api/{$class}.php")){
        require_once "api/{$class}.php";
    }
    else if(file_exists("core/{$class}.php")){
        require_once "core/{$class}.php";
    }
});
?>