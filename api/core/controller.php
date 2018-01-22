<?php
/**
 * Created by ioedeveloper
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