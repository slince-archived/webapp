<?php
namespace App;

use Slince\Application\Kernel;
use Slince\Routing\RouteCollection;
use Slince\Di\Container;
use Slince\Event\Dispatcher;
use Slince\Config\Config;
use Slince\Application\EventStore;
use Slince\Application\Subscriber\ErrorHandler;
use Slince\Application\Subscriber\CakeSubscriber;
use Slince\Application\Listener\MonologListener;
use Slince\Application\Listener\WhoopsListener;

class AppKernel extends Kernel
{

    function getRootPath()
    {
        return __DIR__ . '/../';
    }

    function registerApplications()
    {
        $this->registerApplication(new \DefaultApplication\DefaultApplication());
    }

    function registerConfigs(Config $config)
    {
        $config->load($this->getRootPath() . '/config/app.php');
    }

    function registerServices(Container $container)
    {
        $callback = include $this->getRootPath() . 'config/services.php';
        call_user_func($callback, $container, $this);
    }

    function registerEvents(Dispatcher $dispatcher)
    {
        $dispatcher->addSubscriber(new CakeSubscriber());
        $dispatcher->addListener(EventStore::KERNEL_INITED, new MonologListener());
        if ($this->debug()) {
            $dispatcher->addListener(EventStore::KERNEL_INITED, new WhoopsListener());
        } else {
            $dispatcher->addSubscriber(new ErrorHandler());
        }
    }
    
    function registerRoutes(RouteCollection $routes)
    {
        $callback = include $this->getRootPath() . 'config/routes.php';
        call_user_func($callback, $routes);
    }
}
