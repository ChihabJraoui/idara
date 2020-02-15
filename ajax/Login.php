<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 08/01/2016
 * Time: 22:44
 */

namespace Ajax;



use App\DAO\Member as MemberDAO;

use Controller;
use Cookies;
use Sessions;



class Login extends Controller
{
	public function login()
	{
		// get information
		$pseudo = filter_input(INPUT_POST, "pseudo");
		$password = filter_input(INPUT_POST, "password");
		$save = $_POST["save"];

        $memberDAO = new MemberDAO($this->db);
		$info = array();

		$member = $memberDAO->select($pseudo);

		if($member != null)
		{
			$verifyPassword = password_verify($password, $member->getPassword());

			if ($verifyPassword == true AND $member->getLevel() == 1)
			{
				// set Sessions
				Sessions::set("member_id", $member->getMemberID());
				Sessions::set("logged_in", true);

                if($save == 1)
                {
                    // Set cookies
                    Cookies::set("UPN", $pseudo);
                    Cookies::set("ULI", 'TRUE');
                }

				$info["success"] = 1;
			}
			elseif ($verifyPassword == false)
			{
                // if password false, destroy cookies
                Cookies::destroy('UPN');
                Cookies::destroy('ULI');

				$info["success"] = 0;
				$info["message"] = "password incorrect";
			}
			elseif ($member->getStatus() != 1)
			{
				$info["success"] = 0;
				$info["message"] = "locked membership";
			}
			elseif($member->getLevel() != 4)
			{
				$info["success"] = 0;
				$info["message"] = "you do not have permission";
			}
		}
		else
		{
			$info["success"] = 0;
			$info["message"] = "username incorrect";
		}

		header('Content-Type: application/json');
		echo json_encode($info, JSON_NUMERIC_CHECK);
	}
}