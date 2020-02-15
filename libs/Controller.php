<?php

/*
 *  Main Controller Class.
 */

class Controller
{
    protected $db;
    protected $view;
	protected $user;

    public function __construct()
    {
	    $this->db = new \DBConnection();
	    $this->user = User::getUser($this->db);

        $this->view = new View();
	    $this->view->addData("database", $this->db);
	    $this->view->addData("user", $this->user);
    }
}