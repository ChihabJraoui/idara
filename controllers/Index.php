<?php

/*
 *  Index Controller Class.
 */

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
	    if($this->user->getLevel() > 0)
	    {
		    $this->view->header();
		    $this->view->Render('home');
		    $this->view->footer();
	    }
        elseif($this->user->getLevel() == 0)
        {

        }
    }
    
    public function logout()
    {
        User::logOut();
    }
}

