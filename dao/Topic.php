<?php

/*
 * Data Access Object Topic Class
 */

namespace DAO;

use Objects\Topic as TopicClass;
//use Objects\Notification as NotificationClass;
use \PDO;
use \Func;
use \PDOException;

class Topic
{
	private $db;

	const ATTR_DELETED = 0;
	const ATTR_NORMAL = 1;
	const ATTR_HIDDEN = 2;

	const TYPE_TOPIC = 1;
	const TYPE_FORUM = 2;
	const TYPE_CAT = 3;
	const TYPE_MEMBER = 4;

    public function __construct($db)
    {
	    $this->db = $db;
    }
    
    /* 
     * Private Methodes
     */

    /*
     *  Public Methodes
     */
    public function select($objectType, $id, $topicType = self::ATTR_NORMAL, $limit = null)
    {
	    $objectTypeQuery = "";
	    $topicTypeQuery = "";
	    $result = null;

	    switch ($objectType)
	    {
		    case 1:
			    $objectTypeQuery = "TopicID";
			    break;
		    case 2:
			    $objectTypeQuery = "ForumID";
			    break;
		    case 3:
			    $objectTypeQuery = "CatID";
			    break;
		    case 4:
			    $objectTypeQuery = "Author";
			    break;
	    }

	    switch ($topicType)
	    {
		    case 0:
			    $topicTypeQuery = "Status = 0";
			    break;
		    case 1:
			    $topicTypeQuery = "Status = 1 AND Hidden = 0";
			    break;
		    case 2:
			    $topicTypeQuery = "Status = 1 AND Hidden = 1";
			    break;
	    }

	    if ($limit != null)
	    {
		    $sqlLimit = " LIMIT " . $limit;
	    }
	    else
	    {
		    $sqlLimit = "";
	    }

	    $this->db->query("SELECT * FROM topic WHERE $objectTypeQuery = :id AND $topicTypeQuery
						  ORDER BY Sticky DESC, DateC DESC $sqlLimit");

	    $this->db->bind(":id", $id, PDO::PARAM_INT);
	    $this->db->execute();

	    if ($this->db->rowCount() > 0)
	    {
		    if ($objectType == self::TYPE_TOPIC)
		    {
				$row = $this->db->getResult();
			    $result = new TopicClass($row);
		    }
		    else
		    {
			    $result = array();
			    $rows = $this->db->getResults();

			    foreach($rows as $row)
			    {
				    $result[] = new TopicClass($row);
			    }
		    }
        }
        return $result;
    }

    public function add(TopicClass $t)
    {
        $forumID = $t->getForumID();
        $status = $t->getStatus();
        $subject = htmlspecialchars($t->getSubject());
        $content = Func::editorReplace($t->getContent());
        $author = $t->getAuthor()->getMemberID();

	    $locked = $t->getLocked();
	    $hidden = $t->getHidden();
	    $sticky = $t->getSticky();

        $this->db->query("INSERT INTO topic (ForumID, Status, Subject, Content, Author, DateC,
									LastPostDate, Locked, Hidden, Sticky)
									VALUES (:forumID, :status, :subject, :content, :author, NOW(), NOW(),
									:locked, :hidden, :sticky)");

	    $this->db->bind(":forumID", $forumID, PDO::PARAM_INT);
	    $this->db->bind(":status", $status, PDO::PARAM_INT);
	    $this->db->bind(":subject", $subject, PDO::PARAM_STR);
	    $this->db->bind(":content", $content, PDO::PARAM_STR);
	    $this->db->bind(":author", $author, PDO::PARAM_INT);
	    $this->db->bind(":locked", $locked, PDO::PARAM_INT);
	    $this->db->bind(":hidden", $hidden, PDO::PARAM_INT);
	    $this->db->bind(":sticky", $sticky, PDO::PARAM_INT);
        $this->db->execute();

        //$topicID = $this->db->lastInsertId();
        //
        ///* ----- Add Notification ------ */
        //$notifi = new NotificationClass(array(
        //    "MemberID" => $author,
        //    "ObjectID" => $topicID,
        //    "Type" => "topic"));
        //
        //$NotifDAO = new Notification();
        //$NotifDAO->Add($notifi);

	    /*
	     * update forum table -> lastPost
	     */
    }

    public function update(TopicClass $t)
    {
        $topicID = $t->getTopicID();
        $subject = htmlspecialchars($t->getSubject());
        //$content = \Func::editorReplace($t->getContent());
        $content = $t->getContent();
        $hidden = $t->getHidden();
        $locked = $t->getLocked();
        $sticky = $t->getSticky();

        $this->db->query("UPDATE topic SET Subject = :subject, Content = :content, Hidden = :hidden,
									Locked = :locked, Sticky = :sticky WHERE TopicID = :topicID");
	    $this->db->bind(":subject", $subject);
	    $this->db->bind(":content", $content);
	    $this->db->bind(":hidden", $hidden);
	    $this->db->bind(":locked", $locked);
	    $this->db->bind(":sticky", $sticky);
	    $this->db->bind(":topicID", $topicID);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM topic WHERE TopicID = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();

        $this->db->query("DELETE FROM reply WHERE TopicID = :id");
        $this->db->bind(":id", $id);

            $this->db->execute();
    }

    public function remove($id, $removedBy)
    {
        $this->db->query("UPDATE topic SET Status = 0 WHERE TopicID = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();

        $this->db->query("UPDATE reply SET Status = 0 WHERE TopicID = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();

        // $this->db->query("INSERT INTO removed (TopicID, RemovedBy, RemovedDate)
        // VALUES (:id, :removedBy, NOW())");
        // $this->db->bind(":id", $id);
        // $this->db->bind(":removedBy", $removedBy);
        // return $this->db->execute();
    }

    public function Lock($id, $lockedBy, $lockedCause = "")
    {
        try
        {
            $this->db->query("UPDATE topic SET Locked = 1 WHERE TopicID = :id");
            $this->db->bind(":id", $id);
            $this->db->execute();

            // $this->db->query("INSERT INTO locked_topics (TopicID, LockedBy, LockedDate, LockedCause)
            // VALUES (:id, :lockedBy, NOW(), :lockedCause)");
            // $this->db->bind(":id", $id);
            // $this->db->bind(":lockedBy", $lockedBy);
            // $this->db->bind(":lockedCause", $lockedCause);
            // return $this->db->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function Hide($id, $hiddenBy, $hideCause = "")
    {
        try
        {
            $this->db->query("UPDATE topic SET Hidden = 1 WHERE TopicID = :id");
            $this->db->bind(":id", $id);
            $this->db->execute();

            // $this->db->query("INSERT INTO hidden_topics (TopicID, HiddenBy, HiddenDate, HiddenCause)
            // VALUES (:id, :hiddenBy, NOW(), :hideCause)");
            // $this->db->bind(":id", $id);
            // $this->db->bind(":hiddenBy", $hiddenBy);
            // $this->db->bind(":hideCause", $hideCause);
            // return $this->db->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function Stick($id, $stickBy)
    {
        try
        {
            $this->db->query("UPDATE topic SET Sticky = 1 WHERE TopicID = :id");
            $this->db->bind(":id", $id);
            $this->db->execute();

            // $this->db->query("INSERT INTO sticky_topics (TopicID, StickBy, StickDate)
            // VALUES (:id, :stickBy, NOW())");
            // $this->db->bind(":id", $id);
            // $this->db->bind(":stickBy", $stickBy);
            // return $this->db->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function NumTopics()
    {
        try
        {
            $this->db->query("SELECT 1 FROM topic WHERE Status = 1");
            $this->db->execute();

            return $this->db->rowCount();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function NumReplies($id)
    {
        try
        {
            $this->db->query("SELECT 1 FROM reply WHERE TopicID = :id");
            $this->db->bind(":id", $id);
            $this->db->execute();

            return $this->db->rowCount();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function NumViews($id)
    {
        try
        {
            $this->db->query("SELECT 1 FROM topic_views WHERE TopicID = :id");
            $this->db->bind(":id", $id);
            $this->db->execute();

            return $this->db->rowCount();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }
    
    public function isFavoriteExists($memberID, $topicID)
    {
        try
        {
            $this->db->query("SELECT 1 FROM favorites WHERE MemberID = :mID AND TopicID = :tID");
            $this->db->execute(array(
                ':mID' => $memberID,
                ':tID' => $topicID
            ));
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
        
        return $this->db->rowCount() > 0;
    }


	/*
	 * Topic Likes Functions
	 */
	public function addLike($memberID, $topicID, $like)
	{
		$this->db->query("SELECT TLID FROM topic_likes WHERE TopicID = :tID AND MemberID = :mID");
		$this->db->bind(':tID', $topicID, PDO::PARAM_INT);
		$this->db->bind(':mID', $memberID, PDO::PARAM_INT);
		$this->db->execute();

		if($this->db->rowCount() > 0)
		{
			$row = $this->db->getResult();
			$TLID = $row["TLID"];

			if($like != $row["Likes"])
			{
				$this->db->query("UPDATE topic_likes SET Likes = :likes, DateC = NOW()
											WHERE TLID = :tlid");
				$this->db->bind(':likes', $like, PDO::PARAM_INT);
				$this->db->bind(':tlid', $TLID, PDO::PARAM_INT);
				$this->db->execute();

				return 2; // return 2, if Like is successsfuly updated
			}
			else
			{
				$this->db->query("DELETE FROM topic_likes WHERE TLID = :tlid");
				$this->db->bind(":tlid", $TLID, PDO::PARAM_INT);
				$this->db->execute();

				return 0; // return 0, if Like is successfuly removed
			}
		}
		else
		{
			$this->db->query("INSERT INTO topic_likes (topicID, memberID, Likes, DateC)
							VALUES (:tID, :mID, :likes, NOW())");
			$this->db->bind(':mID', $memberID, PDO::PARAM_INT);
			$this->db->bind(':tID', $topicID, PDO::PARAM_INT);
			$this->db->bind(':likes', $like, PDO::PARAM_INT);
			$this->db->execute();

			return 1; // return 1 if Like is Successfuly added.
		}
	}

	public function isLikeExist($memberID, $topicID)
	{
		$this->db->query("SELECT * FROM topic_likes WHERE TopicID = :tID AND MemberID = :mID");
		$this->db->bind(':mID', $memberID, PDO::PARAM_INT);
		$this->db->bind(':tID', $topicID, PDO::PARAM_INT);
		$this->db->execute();

		if ($this->db->rowCount() > 0)
		{
			$r = $this->db->getResult();

			return intval($r["Likes"]);
		}
		else
		{
			return -1;
		}
	}

	public function getLikes($id)
	{
		try
		{
			$this->db->query("SELECT 1 FROM topic_likes WHERE TopicID = $id AND Likes = 1");
			$this->db->execute();

			return $this->db->rowCount();
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function getDislikes($id)
	{
		try
		{
			$this->db->query("SELECT 1 FROM topic_likes WHERE TopicID = $id AND Likes = 0");
			$this->db->execute();

			return $this->db->rowCount();
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}


	/*
	 * Get Forums Where Member Have Topics.
	 *
	 */
	public function getForums($memberID)
	{
		$this->db->query("SELECT f.ForumID, f.Name, COUNT(t.TopicID) as 'TopicCount'
		FROM topic t INNER JOIN forum f
		ON(t.ForumID = f.ForumID)
		WHERE Author = :mID
		GROUP BY f.ForumID, f.Name");

		$this->db->bind(":mID", $memberID, PDO::PARAM_INT);
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
}