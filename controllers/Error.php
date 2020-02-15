<?php

namespace Idara;


/*
 * Error Controller Class.
 */

class Error extends \Controller
{
    function __construct()
    {
        parent::__construct();
    }


    /*
     * Render 404 Page Not Found Error View
     */
    public function error404()
    {
	    $this->view->header();
        $this->view->Render('error/404');
	    $this->view->footer();
    }
}