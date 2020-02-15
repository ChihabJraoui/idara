<?php

/*
 *  Data Access Object Profile Class
 */

namespace DAO;

use \PDO;
use Objects\Topic as TopicClass;

class Profile
{
	private $db;

    function __construct($db)
    {
	    $this->db = $db;
    }

    function getContactInfo($memberID)
    {
        $this->db->query("SELECT * FROM contact_info WHERE MemberID = :mID");
        $this->db->bind(":mID", $memberID, PDO::PARAM_INT);
        $this->db->execute();

        if($this->db->rowCount() > 0)
        {
            $data = $this->db->getResult();
            return $data;
        }

        return null;
    }


    /*
     * get memebr experience informations.
     */
    function getExpInfo($points)
    {
        $this->db->query("SELECT * FROM points");
        $this->db->execute();

        $info = array();
        $info['expLevel'] = 0;
        $info['currentValue'] = 0;
        $info['maxValue'] = 0;
        
        $pointsRows = $this->db->getResults();

	    foreach ($pointsRows as $r)
	    {
            if ($points >= $r["MinValue"] AND $points <= $r["MaxValue"])
            {
                $info['expLevel'] = $r["Level"];
                $info['currentValue'] = $points - intval($r["MinValue"]);
                $info['maxValue'] = (intval($r["MaxValue"]) - intval($r["MinValue"])) + 1;
            }
        }

        return $info;
    }


    /*
     * get member last 5 topics.
     */
    function getLastTopics($memberID)
    {
        $this->db->query("SELECT * FROM topic WHERE Author = :proID AND Status = 1
                    ORDER BY DateC DESC LIMIT 5");
        $this->db->bind(":proID", $memberID, PDO::PARAM_INT);
        $this->db->execute();

        $topics = array();
        
        if($this->db->rowCount() > 0)
        {
            $rows = $this->db->getResults();
            foreach($rows as $row)
            {
                $topics[] = new TopicClass($row);
            }
        }

        return $topics;
    }
    
    public function isFollowerExists($memberID, $followerID)
    {
	    $this->db->query("SELECT 1 FROM followers WHERE MemberID = :mID AND FollowerID = :followerID");
	    $this->db->bind(':mID', $memberID, PDO::PARAM_INT);
	    $this->db->bind(':followerID', $followerID, PDO::PARAM_INT);
	    $this->db->execute();

		if($this->db->rowCount() > 0)
		{
		    return TRUE;
		}

		return FALSE;
    }


    public function addFollower($memberID, $followerID)
    {
	    $this->db->query("INSERT INTO followers (MemberID, FollowerID, DateC)
				    VALUES ($memberID, $followerID, NOW())");
	    $this->db->execute();
    }
    
    public function removeFollower($memberID, $followerID)
    {
	    $this->db->query("DELETE FROM followers WHERE MemberID = :mID AND FollowerID = :followerID");
	    $this->db->bind(':mID', $memberID, PDO::PARAM_INT);
	    $this->db->bind(':followerID', $followerID, PDO::PARAM_INT);
	    $this->db->execute();
    }

	public function getProfilePictures($memberID)
	{
		$this->db->query("SELECT * FROM profile_photos WHERE MemberID = :mID");
		$this->db->bind(":mID", $memberID);
		$this->db->execute();

		if($this->db->rowCount() > 0)
		{
			return $this->db->getResults();
		}
		else
		{
			return null;
		}
	}


	/*
     * Get Post Profile Link.
	 *
     */
	public function getPostProfileLink($post)
	{
		if($post != null)
		{
			$memberID = $post->getAuthor();
			$date = $post->getDateC();

			$memberDAO = new Member($this->db);
			$member = $memberDAO->select($memberID);

			if ($member != null)
			{
				$color = "";

				if ($member->getStatus() == 1)
				{
					if ($member->getLevel() == 1)
					{
						$color = "Black";
					} elseif ($member->getLevel() == 2)
					{
						$color = "Crimson";
					} elseif ($member->getLevel() == 3)
					{
						$color = "Gold";
					}
				}
				else
				{
					$color = "#888";
				}

				if ($member->getLevel() == 4)
				{
					$color = "DodgerBlue";
				}

				return '
	            <a href="' . \Config::getLink('ProfileLink') . $member->getMemberID() . '" class="pull-right">
	                <table>
	                <tr>
	                    <td rowSpan="2">
	                        <img src="' . $member->getPhoto() . '" height="36" style="margin-left: 4px;" />
	                    </td>
	                    <td noWrap>
	                        <span style="color:' . $color . '; font-size: 12px;">' . $member->getName() . '</span>
	                    </td>
	                </tr>
	                <tr>
	                    <td noWrap>
	                        <span style="font: normal normal 12px tahoma; color: #999;">
	                            ' . \Func::getDateTime($date) . '
	                        </span>
	                    </td>
	                </tr>
	                </table>
	            </a>';
			}
		}

		return null;
	}
}