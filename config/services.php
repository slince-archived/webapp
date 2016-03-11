<?php
use Slince\Di\Container;
use Slince\Routing\RouterFactory;
use Slince\View\ServiceFactory;
use Slince\Application\Kernel;
use Slince\Di\Definition;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\ChromePHPFormatter;

return function (Container $container, Kernel $kernel) {
    //核心组件
    // config
    $container->alias('config', '\\Slince\Config\Config');
    // dispatcher
    $container->alias('dispatcher', '\\Slince\Event\Dispatcher');
    // kernel cache
    $container->alias('kernelCache', '\\Slince\Cache\ArrayCache');
    // router
    $container->share('router', function () {
        return RouterFactory::create();
    });
    $container->share('view', function(){
        $viewManager = ServiceFactory::get('native');
        $viewManager->registerHelperClasses([
            'asset' => '\\Slince\\Application\\Helper\\AssetHelper',
            'url' => '\\Slince\\Application\\Helper\\UrlHelper',
        ]);
        return $viewManager;
    });
    $container->share('log', function () use ($kernel) {
        $handler = new StreamHandler($kernel->getRootPath() . 'tmp/logs/app.log');
        return new Logger('app', [$handler]);
    });
    $container->setDefinition('cache', new Definition('\\Slince\\Cache\\FileCache', [
        $kernel->getRootPath() . 'tmp/cache'
    ]), true);
};