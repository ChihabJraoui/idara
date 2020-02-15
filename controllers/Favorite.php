<?php

class FavoriteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->addJS('ajax_favorite');

        $this->view->render('favorite');
    }
}