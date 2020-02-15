<?php

/*
 * Data Access Object Reply Class
 */

namespace DAO;

use Objects\Reply as ReplyClass;
use \PDO;
use \PDOException;

class Reply
{
	private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    /*
     * PUBLIC Functions
     */
    public function selectAll($topicID = 0, $memberID = 0)
    {
        $and = "";
        if ($topicID != 0)
        {
            $and .= "TopicID = $topicID AND";
        }
        if ($memberID != 0)
        {
            $and .= "Author = $memberID AND";
        }

        $this->db->query("SELECT * FROM reply WHERE $and Status = 1 ORDER BY DateC DESC");
        $this->db->execute();

	    $Replies = array();
	    if ($this->db->rowCount() > 0)
	    {
		    $rows = $this->db->getResults();
		    foreach ($rows as $row)
		    {
			    $Replies[] = new ReplyClass($row);
		    }
	    }

	    return $Replies;
    }

    public function selectById($id)
    {
        $this->db->query("SELECT * FROM reply WHERE ReplyID = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();

        if ($this->db->rowCount() > 0)
        {
            $data = $this->db->getResult();
            $reply = new ReplyClass($data);
            return $reply;
        }
        return null;
    }

    public function add(ReplyClass $r)
    {
        $tID = $r->getTopicID();
        $status = $r->getStatus();
        $content = $r->getContent();
        $author = $r->getAuthor();
        $authorID = $author->getMemberID();
        $dateC = $r->getDateC();

        $this->db->query("INSERT INTO reply (TopicID, Status, Content, Author, DateC)
				VALUES (:tID, :status, :content, :author, :date)");
        $this->db->bind(":tID", $tID);
        $this->db->bind(":status", $status);
        $this->db->bind(":content", $content);
        $this->db->bind(":author", $authorID);
        $this->db->bind(":date", $dateC);

	    if($this->db->execute())
	    {
		    return 1;
	    }
	    else
	    {
		    return $this->db->getError();
	    }

	    /*
	     * update forum table -> lastPost
	     * update user points
	     * update user posts
	     */
    }

    public function updateValue($id, $key, $val)
    {
        $this->db->query("UPDATE reply SET $key = :val WHERE ReplyID = :id");
        $this->db->bind(":val", $val, PDO::PARAM_STR);
        $this->db->bind(":id", $id, PDO::PARAM_INT);

	    if ($this->db->execute())
	    {
		    return 1;
	    }
	    else
	    {
		    return $this->db->getError();
	    }
    }

    public function remove($id)
    {
        $this->db->query("UPDATE reply SET Status = 0 WHERE ReplyID = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);

	    if ($this->db->execute())
	    {
		    return 1;
	    }
	    else
	    {
		    return $this->db->getError();
	    }
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM reply WHERE ReplyID = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);

	    if ($this->db->execute())
	    {
		    return 1;
	    }
	    else
	    {
		    return $this->db->getError();
	    }
    }
}