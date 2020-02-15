<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 10/11/2015
 * Time: 12:48 AM
 */

namespace DAO;

use Objects\Member as MemberClass;
use \PDO;

class Favorite
{
	private $db;

    function __construct($db)
    {
	    $this->db = $db;
    }

	public function add($memberID, $topicID)
	{
		$this->db->query("INSERT INTO favorites (MemberID, TopicID, DateC)
                          VALUES (:mID, :tID, NOW())");
		$this->db->bind(':mID', $memberID, PDO::PARAM_INT);
		$this->db->bind(':tID', $topicID, PDO::PARAM_INT);

		if($this->db->execute())
		{
			return 1;
		}
		else
		{
			return $this->db->getError();
		}
	}

    public function getTopics(MemberClass $M, $SqlLimit)
    {
	    $memberID = $M->getMemberID();

	    $this->db->query("SELECT * FROM favorites WHERE MemberID = :mID LIMIT " . $SqlLimit);
	    $this->db->bind(":mID", $memberID, PDO::PARAM_INT);
	    $this->db->execute();

	    if($this->db->rowCount() > 0)
	    {
			$topics = array();
		    $topicDAO = new Topic($this->db);
		    $rows = $this->db->getResults();
		    foreach($rows as $row)
		    {
			    $topics[] = $topicDAO->select(Topic::TYPE_TOPIC, $row['TopicID']);
		    }
		    return $topics;
	    }
	    else
	    {
		    return null;
	    }
    }

	public function delete($topicID, $memberID)
	{
		$this->db->query("DELETE FROM favorites WHERE TopicID = :tID AND MemberID = :mID");
		$this->db->bind(":mID", $memberID, PDO::PARAM_INT);
		$this->db->bind(":tID", $topicID, PDO::PARAM_INT);

		if($this->db->execute())
		{
			return 1;
		}
		else
		{
			return $this->db->getError();
		}
	}

	public function getNumTopics($memberID)
	{
		$this->db->query("SELECT * FROM favorites WHERE MemberID = :mID");
		$this->db->bind(":mID", $memberID, PDO::PARAM_INT);
		$this->db->execute();

		return $this->db->rowCount();
	}
}