<?php

/* 
 * User Member Class.
 */

use App\DAO\Member as MemberDAO;
use App\Object\Member as Member;



class User
{
	public static function getUser($database)
	{
		$memberDAO = new MemberDAO($database);
		$member = null;

		if(Sessions::isExist("logged_in") AND Sessions::get('logged_in') == true)
		{
			$member = $memberDAO->select(Sessions::get("member_id"));
		}
		elseif(Cookies::isExist('ULI') AND Cookies::get('ULI') == 'TRUE')
		{
			$pseudo = Cookies::get('UPN');

			$m = $memberDAO->select($pseudo);

			if($m != null)
			{
				Sessions::set('member_id', $m->getMemberID());
				Sessions::set('logged_in', true);
				$member = $m;
			}

		}
		else
		{
			$member = new Member(array(
				'MemberID' => 0,
				'Level' => 0
			));
		}

		return $member;
	}

    public static function getPreUrl()
    {
	    if (filter_input(INPUT_SERVER, 'HTTP_REFERER'))
	    {
		    return filter_input(INPUT_SERVER, 'HTTP_REFERER');
	    }
	    else
	    {
		    return null;
	    }
    }

	public static function isLoggedIn()
	{
		if(Sessions::isExist('logged_in') AND Sessions::get('logged_in') == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    public static function logOut()
    {
        Sessions::destroy();

        Cookies::destroy('ULI');
        Cookies::destroy('UPN');

        Func::redirect('../index', true);
    }
}