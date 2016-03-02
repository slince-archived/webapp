<?php
namespace DefaultApplication\Controller;

class PagesController extends AppController
{

    /**
     * 网站首页
     */
    function index()
    {
        echo 123;
        throw new \Exception('heheda');
//         trigger_error('hehe', E_USER_WARNING);
    }
}