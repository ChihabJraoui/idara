<?php

/*
 *  Forum Controller Class
 */

class Forum extends Controller
{
    
    function __construct()
    {
        parent::__construct();

        $this->view->addJS("js/forum.js");
    }

    public function index()
    {
	    $this->view->header();
	    $this->view->render('forum/index');
	    $this->view->footer();
    }

	public function add()
	{
		$this->view->render('forum/add');
	}

	public function order()
	{
		$this->view->render("forum/order");
	}

	public function edit()
	{
		$this->view->render("forum/edit");
	}
}