<?php

namespace DAO;

class TopicViews
{
	private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function Add($topicID, $IP, $memberID)
    {
        $add = false;
        $sql1 = $this->db->query("SELECT 1 FROM topic_views WHERE TopicID = $topicID AND IP = '$IP'");
        if ($sql1->num_rows > 0)
        {
            $sql2 = $this->db->query("SELECT 1 FROM topic_views WHERE TopicID = $topicID AND MemberID = $memberID");
            if ($sql2->num_rows > 0)
            {
                $add = false;
            }
            else
            {
                $add = true;
            }
        }
        else
        {
            $add = true;
        }
        if ($add)
        {
            $this->db->query("INSERT INTO topic_views (TopicID, IP, MemberID, DateV)
								VALUES ($topicID, '$IP', $memberID, NOW())");
        }
    }
}