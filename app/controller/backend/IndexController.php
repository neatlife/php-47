<?php

namespace app\controller\backend;

class IndexController extends \core\Controller
{
    public function __construct()
    {
        $this->denyAccess();
    }

    public function index()
    {
        $this->denyAccess();
        $this->loadHtml('index/index');
    }

    public function header()
    {
        $this->denyAccess();
        $this->loadHtml('index/header');
    }

    public function menu()
    {
        $this->denyAccess();
        $this->loadHtml('index/menu');
    }

    public function content()
    {

        $this->denyAccess();
        $this->loadHtml('index/content');
    }
}