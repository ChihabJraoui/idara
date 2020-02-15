<?php

/*
 * Data Access Object Forum Class
 */

namespace App\DAO;



use App\Object\Forum as ForumClass;
use \Objects\Reply as ReplyClass;

use \PDO;



class Forum
{

	private $db;

	const TYPE_FORUM = 1;
	const TYPE_CAT = 2;



    public function __construct($db)
    {
	    $this->db = $db;
    }
    


    /*
     * Private Function
     */
    private function getForumOrder()
    {
        $this->db->query("SELECT ForumOrder FROM forum ORDER BY ForumOrder DESC LIMIT 1");
        $this->db->execute();

        if($this->db->count() > 0)
        {
            $r = $this->db->getResult();
            $fOrder = $r["ForumOrder"];
        }
        else
        {
            $fOrder = 1;
        }

        return $fOrder;
    }


    
    /*
     * Public Methodes
     */
    public function select($id)
    {
        $this->db->query("SELECT * FROM forum WHERE ForumID = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->execute();

        if($this->db->count() > 0)
        {
            $row = $this->db->getResult();

            return new ForumClass($row);
        }
        else
        {
            return null;
        }
    }
	
    public function add(ForumClass $F)
    {
        $idCat = $F->getCatID();
        $name = $F->getName();
        $description = $F->getDescription();
        $icon = $F->getIcon();
        $sex = $F->getSex();
        $hide = $F->getHide();
        $level = $F->getLevel();        

	    // Get Forum Order using getForumOrder Function
        $fOrder = $this->getForumOrder();    

        $this->db->query("INSERT INTO forum (CatID, Name, Description, ForumOrder, Icon, Sex, Hide, Level)
                                    VALUES (:catID, :name, :description, :fOrder, :icon, :sex, :hide, :level)");
        $this->db->bind(":catID", $idCat, PDO::PARAM_INT);
        $this->db->bind(":name", $name, PDO::PARAM_STR);
        $this->db->bind(":description", $description, PDO::PARAM_STR);
        $this->db->bind(":fOrder", $fOrder, PDO::PARAM_INT);
        $this->db->bind(":icon", $icon, PDO::PARAM_STR);
        $this->db->bind(":sex", $sex, PDO::PARAM_STR);
        $this->db->bind(":hide", $hide, PDO::PARAM_INT);
        $this->db->bind(":level", $level, PDO::PARAM_INT);

        $this->db->execute();
    }
	
	public function update(ForumClass $F)
	{
		$forumID = $F->getForumID();
		$name = $F->getName();
		$description = $F->getDescription();
		$icon = $F->getIcon();
		$sex = $F->getSex();
		$hide = $F->getHide();
		$level = $F->getLevel();

		$this->db->query("UPDATE forum SET Name = :name, Description = :description,
                          Icon = :icon, Sex = :sex, Hide = :hide, Level = :level
                          WHERE ForumID = :forumID");

		$this->db->bind(":forumID", $forumID, PDO::PARAM_INT);
		$this->db->bind(":name", $name, PDO::PARAM_STR);
		$this->db->bind(":description", $description, PDO::PARAM_STR);
		$this->db->bind(":icon", $icon, PDO::PARAM_STR);
		$this->db->bind(":sex", $sex, PDO::PARAM_STR);
		$this->db->bind(":hide", $hide, PDO::PARAM_INT);
		$this->db->bind(":level", $level, PDO::PARAM_INT);

		$this->db->execute();
	}

    public function updateOrder(array $idArray, array $orderArray)
    {
        $errors = 0;

        for($i = 0; $i < count($idArray); $i++)
        {
            $forumId = $idArray[$i];
            $order = $orderArray[$i];

            $this->db->query("UPDATE forum SET ForumOrder = :forumOrder
                              WHERE ForumID = :id");

            $this->db->bind(":id", $forumId, PDO::PARAM_INT);
            $this->db->bind(":forumOrder", $order, PDO::PARAM_INT);

            if (!$this->db->execute())
            {
                $errors++;
            }
        }

        return $errors == 0;
    }
	
	public function delete($id)
	{
		$this->db->query("DELETE FROM forum WHERE ForumID = $id");

        $this->db->execute();
	}
	
    public function NumTopics($id)
    {
        $this->db->query("SELECT 1 FROM topic WHERE ForumID = $id AND Status = 1");
        $this->db->execute();
        return $this->db->count();
    }
	
    public function NumReplies($id)
    {
        $this->db->query("SELECT 1 FROM reply r INNER JOIN topic t
							ON (r.TopicID = t.TopicID)
							WHERE t.ForumID = :id AND r.Status = 1");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->count();
    }

    public function lastReply($topicID)
    {
	    $this->db->query("SELECT * FROM reply
									WHERE TopicID = :topicID AND Status = 1
                                    ORDER BY DateC DESC LIMIT 1");

	    $this->db->bind(":topicID", $topicID, PDO::PARAM_INT);

        $this->db->execute();
        
        if ($this->db->count() > 0)
        {
            $dataLastReply = $this->db->getResult();
            $reply = new ReplyClass($dataLastReply);
            return $reply;
        }
	    else
	    {
		    return null;
	    }
    }
}