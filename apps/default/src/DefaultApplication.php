<?php
namespace DefaultApplication;

use Slince\Application\Application;

class DefaultApplication extends Application
{

    protected $name = 'Default';

    protected $theme = false;

    function getRootPath()
    {
        return __DIR__ . '/../';
    }
}