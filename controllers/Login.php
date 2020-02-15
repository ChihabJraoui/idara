<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 07/01/2016
 * Time: 21:59
 */

Class Login extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $this->view->addJS("js/login.js");

        $this->view->header();
		$this->view->render("login");
        $this->view->footer();
	}
}