<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 09/12/2015
 * Time: 19:14
 */

class Category extends Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->view->addJS('js/category.js');
	}


	public function index()
	{
		$this->view->header();
		$this->view->render("categories/index");
		$this->view->footer();
	}

	public function add()
	{
		$this->view->render("categories/add");
	}

	public function order()
	{
		$this->view->header();
		$this->view->render("categories/order");
		$this->view->footer();
	}

    public function edit()
    {
        $catId = filter_input(INPUT_POST, 'catId');

        $this->view->addData('catId', $catId);

        $this->view->render("categories/edit");
    }
}