<?php
/**
 * 路由配置
 */
use Slince\Routing\RouteCollection;

return function(RouteCollection $routes) {
    //网站首页
    $routes->http('/', 'Default@PagesController@index');
    //单页
    $routes->http('/{id}', 'Default@PagesController@show')
        ->setRequirement('id', '\d+');
};