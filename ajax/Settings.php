<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 13:21
 */

namespace Ajax;

use \Controller;
use DAO\WebConfig;

class Settings extends Controller
{
	private $webConfigDAO;

	public function __construct()
	{
		parent::__construct();

		$this->webConfigDAO = new WebConfig($this->db);
	}

	public function updateValues()
	{
		$data = array(
			"Title" => filter_input(INPUT_POST, "title"),
			"Description" => filter_input(INPUT_POST, "desc"),
			"Keywords" => filter_input(INPUT_POST, "keywords"),
			"Logo" => filter_input(INPUT_POST, "logo"),
			"Address" => filter_input(INPUT_POST, "address"),
			"AdminAddress" => filter_input(INPUT_POST, "adminAddress"),
			"Copyright" => filter_input(INPUT_POST, "copyright"),
			"ImageFolder" => filter_input(INPUT_POST, "imageFolder"),
			"Email" => filter_input(INPUT_POST, "email"),
			"Author" => filter_input(INPUT_POST, "author"),
		);

		if($this->webConfigDAO->updateValues($data))
        {
            echo 'success';
        }
        else
        {
            echo $this->db->getError();
        }
	}

	public function updateValue()
	{

	}
}