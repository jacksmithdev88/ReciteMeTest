<?php

class BaseController
{
    public static function create($viewname)
    {
        require_once './views/' . $viewname;
    }
}
