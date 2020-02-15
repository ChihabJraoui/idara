<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 16/12/2015
 * Time: 22:47
 */

namespace Ajax;

use \Controller;
use Objects\Category as CatClass;

class Category extends Controller
{
	private $catDAO;

	public function __construct()
	{
		parent::__construct();

		$this->catDAO = new \DAO\Category($this->db);
	}

	public function add()
	{
		$cat = new CatClass(array(
            "Name" => filter_input(INPUT_POST, "name"),
            "Hide" => filter_input(INPUT_POST, "hide"),
            "Level" => filter_input(INPUT_POST, "level"),
        ));

		if($this->catDAO->add($cat))
        {
            echo 'success';
        }
        else
        {
            echo $this->db->getError();
        }
	}

	public function update()
	{
		$data = array(
			"CatID" => filter_input(INPUT_POST, "catId"),
			"Name" => filter_input(INPUT_POST, "name"),
			"Hide" => filter_input(INPUT_POST, "hide"),
			"Level" => filter_input(INPUT_POST, "level"),
		);

		$cat = new CatClass($data);

		if($this->catDAO->update($cat))
        {
            echo 'success';
        }
        else
        {
            echo $this->db->getError();
        }
	}

	public function delete()
	{
		$catID = filter_input(INPUT_POST, "catID");

		if ($this->catDAO->delete($catID))
        {
            echo 'success';
        }
        else
        {
            echo $this->db->getError();
        }
	}

	public function order()
	{
        $idArray = $_POST["catID"];
        $orderArray = $_POST["order"];

        if ($this->catDAO->updateOrder($idArray, $orderArray))
        {
            echo 'success';
        }
        else
        {
            echo $this->db->getError();
        }
	}
}