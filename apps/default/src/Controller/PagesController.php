<?php
namespace DefaultApplication\Controller;

use Slince\Application\Exception\NotFoundException;

class PagesController extends AppController
{

    /**
     * 网站首页
     */
    function index()
    {
//         throw new NotFoundException('heheda');
        trigger_error('hehe', E_USER_WARNING);
    }
}