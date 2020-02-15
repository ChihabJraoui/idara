<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 16/12/2015
 * Time: 22:47
 */

namespace Ajax;



use Controller;
use PDOException;

use App\DAO\Forum as ForumDAO;
use App\Object\Forum as ForumClass;



class Forum extends Controller
{

	private $forumDAO;



	public function __construct()
	{
		parent::__construct();

		$this->forumDAO = new ForumDAO($this->db);
	}



	public function add()
	{
		$forum = new ForumClass(array(
            "CatID" => $_POST["catId"],
            "Name" => filter_input(INPUT_POST, "name"),
            "Description" => filter_input(INPUT_POST, "desc"),
            "Icon" => filter_input(INPUT_POST, "icon"),
            "Sex" => filter_input(INPUT_POST, "sex"),
            "Hide" => filter_input(INPUT_POST, "hide"),
            "Level" => filter_input(INPUT_POST, "level")
        ));

        try
        {
            $this->forumDAO->add($forum);

            echo 'success';
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	}

	public function edit()
	{
		$forum = new ForumClass(array(
			"ForumID" => filter_input(INPUT_POST, "forumId"),
			"CatID" => filter_input(INPUT_POST, "catID"),
			"Name" => filter_input(INPUT_POST, "name"),
			"Description" => filter_input(INPUT_POST, "description"),
			"Icon" => filter_input(INPUT_POST, "icon"),
			"Sex" => filter_input(INPUT_POST, "sex"),
			"Hide" => filter_input(INPUT_POST, "hide"),
			"Level" => filter_input(INPUT_POST, "level"),
		));

        try
        {
            $this->forumDAO->update($forum);

            echo 'success';
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	}

	public function delete()
	{
		$forumId = $_POST["forumId"];

        try
        {
            $this->forumDAO->delete($forumId);

            echo 'success';
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	}

	public function order()
	{
        $idArray = $_POST["forumId"];
        $orderArray = $_POST["forumOrder"];

        if ($this->forumDAO->updateOrder($idArray, $orderArray))
        {
            echo 'success';
        }
        else
        {
            echo $this->db->getError();
        }
    }
}