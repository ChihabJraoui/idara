<?php

namespace DAO;

use \PDO;

class Statistics
{
	private $db;

    private $thisWeek;
    private $thisMonth;
    private $thisYear;

    public function __construct($db)
    {
        $this->db = $db;
        
        $this->thisWeek = date("W");
        $this->thisMonth = date("m");
        $this->thisYear = date("Y");
    }

    public function websiteHits()
    {
        $this->db->query("SELECT WEEKDAY(DateC) as 'Day', Hits as 'Data' FROM website_hits
                            WHERE YEAR(DateC) = :thisYear AND WEEKOFYEAR(DateC) = :thisWeek
                            GROUP BY Day");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->bind(":thisYear", $this->thisYear, PDO::PARAM_INT);
        $this->db->execute();

        $data = array();

        $rows = $this->db->getResults();

	    for ($i = 0; $i < 7; $i++)
        {
            $data["days"][] = $i;
            $data["data"][] = 0;
        }

	    foreach ($rows as $row)
        {
            $day = intval($row["Day"]);
            $data["data"][$day] = intval($row["Data"]);
        }

	    return $data;
    }

    public function uniqueVisitors()
    {
        $this->db->query("SELECT WEEKDAY(DateTimeC) as 'Day', COUNT(WVID) as 'Data' FROM website_visitors
                            WHERE YEAR(DateTimeC) = :thisYear AND WEEKOFYEAR(DateTimeC) = :thisWeek
                            GROUP BY Day");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->bind(":thisYear", $this->thisYear, PDO::PARAM_INT);
        $this->db->execute();

        $data = array();

	    $rows = $this->db->getResults();

	    for ($i = 0; $i < 7; $i++)
        {
            $data["data"][] = 0;
        }

	    foreach ($rows as $row)
        {
            $day = intval($row["Day"]);
            $data["data"][$day] = intval($row["Data"]);
        }

	    return $data;
    }

    public function topicsThisMonth($object)
    {
        $class = get_class($object);

        if ($class == "Member")
        {
            $id = $object->getMemberID();
            $this->db->query("SELECT DAY(DateC) as 'Day', COUNT(TopicID) as 'Y' FROM topic WHERE Author = :id
								AND YEAR(DateC) = :year AND MONTH(DateC) = :month GROUP BY Day");
        }
        elseif ($class == "Forum")
        {
            $id = $object->getForumID();
            $this->db->query("SELECT DAY(DateC) as 'Day', COUNT(TopicID) as 'Y' FROM topic WHERE ForumID = :id
								AND YEAR(DateC) = :year AND MONTH(DateC) = :month GROUP BY Day");
        }

 	    $this->db->bind(":id", $id, \PDO::PARAM_INT);
        $this->db->bind(":month", $this->thisMonth, \PDO::PARAM_INT);
        $this->db->bind(":year", $this->thisYear, \PDO::PARAM_INT);
        $this->db->execute();

        $data = array();

        $rows = $this->db->getResults();

	    for ($i = 1; $i <= 31; $i++)
        {
            $data[] = array("label" => $i, "y" => 0);
        }

	    foreach ($rows as $row)
        {
            $day = intval($row["Day"]);
            $data[$day] = array("label" => $day, "y" => intval($row["Y"]));
        }

	    return json_encode($data);
    }

    public function repliesThisMonth($object)
    {
        $class = get_class($object);
        if ($class == "Member")
        {
            $id = $object->getMemberID();
            $this->db->query("SELECT DAY(DateC) as 'Day', COUNT(ReplyID) as 'Y' FROM reply WHERE Author = :id
                                        AND YEAR(DateC) = :year AND MONTH(DateC) = :month GROUP BY Day");
        }
        elseif ($class == "Forum")
        {
            $id = $object->getForumID();
            $this->db->query("SELECT DAY(r.DateC) as 'Day', COUNT(ReplyID) as 'Y' FROM topic t INNER JOIN reply r
                                        ON (t.TopicID = r.TopicID)
                                        WHERE t.ForumID = :id AND YEAR(r.DateC) = :year AND MONTH(r.DateC) = :month
                                        GROUP BY Day");
        }

        $this->db->bind(":id", $id);
        $this->db->bind(":month", $this->thisMonth);
        $this->db->bind(":year", $this->thisYear);
        $this->db->execute();

        $data = array();

        $rows = $this->db->getResults();

	    for ($i = 1; $i <= 31; $i++)
        {
            $data[] = array("label" => $i, "y" => 0);
        }

	    foreach ($rows as $row)
        {
            $day = intval($row["Day"]);
            $data[$day] = array("label" => $day, "y" => intval($row["Y"]));
        }

	    return json_encode($data);
    }

    public function getNumTopics($object = null)
    {
	    $query = ""; $id = 0;
        if ($object == null)
        {
            $query = "SELECT 1 FROM topic WHERE Status = 1";
        }
        else
        {
            $className = get_class($object);

            if ($className == "Member")
            {
                $id = $object->getMemberID();
                $query = "SELECT 1 FROM topic WHERE Author = :id";
            }
            elseif ($className == "Forum")
            {
                $id = $object->getForumID();
                $query = "SELECT 1 FROM topic WHERE ForumID = :id";
            }
        }

	    $this->db->query($query);
	    $this->db->bind(":id", $id);
	    $this->db->execute();

	    return $this->db->count();
    }

    public function getNumReplies($object = null)
    {
        if ($object == null)
        {
            $this->db->query("SELECT 1 FROM reply WHERE Status = 1");
            $this->db->execute();
            return $this->db->count();
        }
        else
        {
            $className = get_class($object);
	        $query = ""; $id = 0;

            if ($className == "Member")
            {
                $id = $object->getMemberID();
                $query = "SELECT 1 FROM reply WHERE Author = :id";
            }
            elseif ($className == "Forum")
            {
                $id = $object->getForumID();
                $query = "SELECT 1 FROM reply WHERE ForumID = :id";
            }
            elseif ($className == "Topic")
            {
                $id = $object->getTopicID();
                $query = "SELECT 1 FROM reply WHERE TopicID = :id";
            }

	        $this->db->query($query);
	        $this->db->bind(":id", $id);
	        $this->db->execute();

	        return $this->db->count();
        }
    }

    public function getNumMembers()
    {
        $this->db->query("SELECT 1 FROM member");
        $this->db->execute();

	    return $this->db->count();
    }

    public function getNumFollowings($mID)
    {
        $this->db->query("SELECT 1 FROM followers WHERE FollowerID = :memberID");
        $this->db->bindParam(":memberID", $mID, PDO::PARAM_INT);
        $this->db->execute();

	    return $this->db->count();
    }

    public function getNumFollowers($mID)
    {
        $this->db->query("SELECT 1 FROM followers WHERE MemberID = :memberID");
        $this->db->bindParam(":memberID", $mID, PDO::PARAM_INT);
        $this->db->execute();

	    return $this->db->count();
    }

    public function getNewMembersRatio()
    {
        $this->db->query("SELECT COUNT(MemberID) as 'OldMembers' FROM member
                          WHERE WEEKOFYEAR(RegisterDate) = :thisWeek - 1");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->execute();

        $data = $this->db->getResult();
        $oldMembers = $data["OldMembers"];

        $newMembers = $this->getNewMembers();

        $ratio = \Func::newRatio($oldMembers, $newMembers);

        return $ratio;
    }

    public function getTotalMembersRatio()
    {
        $totalMembers = $this->getTotalMembers();

        $newMembers = $this->getNewMembers();

        $ratio = \Func::totalRatio($totalMembers, $newMembers);

        return $ratio;
    }

    public function getNewMembers()
    {
        $this->db->query("SELECT COUNT(MemberID) as 'newMembers' FROM member
                          WHERE WEEKOFYEAR(RegisterDate) = :thisWeek");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->execute();

        $data = $this->db->getResult();

        return $data["newMembers"];
    }

    public function getTotalMembers()
    {
        $this->db->query("SELECT COUNT(MemberID) as 'TotalMembers' FROM member
                          WHERE WEEKOFYEAR(RegisterDate) != :thisWeek");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->execute();

        $data = $this->db->getResult();

        return $data["TotalMembers"];
    }

    public function getNewVisitorsRatio()
    {
        $this->db->query("SELECT COUNT(WVID) as 'OldVisitors' FROM website_visitors
                          WHERE WEEKOFYEAR(DateTimeC) = :thisWeek - 1");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->execute();

        $data = $this->db->getResult();
        $oldVisitors = $data["OldVisitors"];

        $newVisitors = $this->getNewVisitors();

        $ratio = \Func::newRatio($newVisitors, $oldVisitors);

        return $ratio;
    }

    public function getNewVisitors()
    {
        $this->db->query("SELECT COUNT(WVID) as 'NewVisitors' FROM website_visitors
                          WHERE WEEKOFYEAR(DateTimeC) = :thisWeek");
        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->execute();

        $data = $this->db->getResult();

        return $data["NewVisitors"];
    }

    public function getTotalVisitors()
    {
        $this->db->query("SELECT COUNT(WVID) as 'TotalVisitors' FROM website_visitors
                          WHERE WEEKOFYEAR(DateTimeC) != :thisWeek");

        $this->db->bind(":thisWeek", $this->thisWeek, PDO::PARAM_INT);
        $this->db->execute();

        $data = $this->db->getResult();

        return $data["TotalVisitors"];
    }

    public function getTotalVisitorsRatio()
    {
        $totalVisitors = $this->getTotalVisitors();

        $newVisitors = $this->getNewVisitors();

        $ratio = \Func::newRatio($totalVisitors, $newVisitors);

        return round($ratio);
    }
}