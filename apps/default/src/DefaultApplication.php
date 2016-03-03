<?php
namespace DefaultApplication;

use Slince\Application\Application;

class DefaultApplication extends Application
{

    protected $name = 'Default';

    protected $theme = 'default';

    function getRootPath()
    {
        return __DIR__ . '/../';
    }
}