<?php
/**
 * Created by root
 * Date: 1/22/18
 * Time: 5:24 AM
 */

class controller
{
    public function model($model)
    {
        return new $model();
    }
}