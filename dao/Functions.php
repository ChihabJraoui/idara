<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 10/13/2015
 * Time: 12:21 AM
 */


/*
 * Data Access Functions Class
 * functions need DataBase Connection.
 */

namespace DAO;

use PDO;

class Functions
{
	private $db;

	private $memberDAO;
	private $forumDAO;

	public function __construct($database)
	{
		$this->db = $database;

		$this->memberDAO = new Member($this->db);
		$this->forumDAO = new Forum($this->db);
	}


	/*
	 * this methodes needs impovement !
	 */
	public function isAllowed($mID, $fID)
	{
		$member = $this->memberDAO->Select($mID);
		$forum = $this->forumDAO->select(Forum::TYPE_FORUM, $fID);

		if ($member != null)
		{
			if ($member->getLevel() == 4)
			{
				return true;
			}
			elseif ($member->getLevel() == 3)
			{
				$catID = $forum->getCatID();
				$memberID = $member->getMemberID();


				$this->db->query("SELECT 1 FROM moderation WHERE CatID = :catID AND
					MemberID = :memnerID");
				$this->db->bind(":catID", $catID, PDO::PARAM_INT);
				$this->db->bind(":memberID", $memberID, PDO::PARAM_INT);
				$this->db->execute();

				if ($this->db->rowCount() > 0)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif ($member->getLevel() == 2)
			{
				$forumID = $forum->getForumID();
				$memberID = $member->getMemberID();

				$this->db->query("SELECT 1 FROM moderation WHERE ForumID = :forumID AND
					MemberID = :memnerID");
				$this->db->bind(":catID", $forumID, PDO::PARAM_INT);
				$this->db->bind(":memberID", $memberID, PDO::PARAM_INT);
				$this->db->execute();

				if ($this->db->rowCount() > 0)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function addHit()
	{
		$this->db->query("SELECT 1 FROM website_hits WHERE DateC = CURDATE()");
		$this->db->execute();
		if($this->db->rowCount() > 0)
		{
			$this->db->query("UPDATE website_hits SET Hits = Hits + 1 WHERE DateC = CURDATE()");
			$this->db->execute();
		}
		else
		{
			$this->db->query("INSERT INTO website_hits (Hits, DateC) VALUES (1, CURDATE())");
			$this->db->execute();
		}
	}

	public function addVisitor()
	{
		//        global $ipM;
		//        $ip = $ipM->getIP();
		//        $this->db->query("SELECT * FROM website_visitors WHERE IP = :ip AND DATE(DateTimeC) = CURDATE()");
		//        $this->db->bind(":ip", $ip);
		//        $this->db->execute();
		//
		//        if($this->db->rowCount() == 0)
		//        {
		//            $s2 = $this->db->query("INSERT INTO website_visitors (IP, DateTimeC) VALUES (:ip, NOW())");
		//            $s2->bind(":ip", $ip);
		//            $s2->execute();
		//        }
	}
}