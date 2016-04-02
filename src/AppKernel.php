<?php
namespace App;

use Slince\Application\Kernel;
use Slince\Routing\RouteCollection;
use Slince\Di\Container;
use Slince\Event\Dispatcher;
use Slince\Config\Config;

class AppKernel extends Kernel
{

    function registerApplications()
    {
        $applications = [
            new \DefaultApplication\DefaultApplication(),
        ];
        return $applications;
    }

    function registerBridges()
    {
        $bridges = [
            new \Slince\CakeBridge\CakeBridge(),
            new \Slince\MonologBridge\MonologBridge(),
        ];
        if ($this->debug()) {
            $bridges += [
                new \Slince\WhoopsBridge\WhoopsBridge()
            ];
        }
        return $bridges;
    }

    function registerConfigs(Config $config)
    {
        $config->load($this->getConfigPath() . '/app.php');
    }

    function registerServices(Container $container)
    {
        $callback = include $this->getConfigPath() . '/services.php';
        call_user_func($callback, $container, $this);
    }

    function registerEvents(Dispatcher $dispatcher)
    {
        $dispatcher->addSubscriber(new \Slince\Application\ErrorHandler());
    }

    function registerRoutes(RouteCollection $routes)
    {
        $callback = include $this->getConfigPath() . '/routes.php';
        call_user_func($callback, $routes);
    }
}
