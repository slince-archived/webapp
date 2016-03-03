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
        $this->render('index', true);
    }
}