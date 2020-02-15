<?php

/*
 * Settings Controller Class
 */

class Settings extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->view->addJS("js/settings.js");

		$this->view->header();
		$this->view->render('settings/config');
        $this->view->footer();
	}
}