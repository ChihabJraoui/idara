<?php

namespace Idara;

use Func;


/* 
 *  Editor Controller Class.
 */

class Editor extends \Controller
{

    public function  __construct()
    {
	    parent::__construct();
    }

    function editTopic()
    {
        if(!empty($_GET['t']))
        {
            $this->view->Render('edit_topic');
        }
        else
        {
            Func::Redirect('../', true);
        }
    }

    public function newTopic()
    {
        if(!empty($_GET['f']))
        {
	        $this->view->addJS('ajax_editor.js');
	        $this->view->header();
            $this->view->Render('new_topic');
        }
        else
        {
            Func::Redirect('../', true);
        }
    }

}