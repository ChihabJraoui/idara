<?php

/*
 * Online Data Access Object Class.
 */

namespace DAO;

use \Objects\Online as OnlineClass;
use \PDO;

class Online
{
	private $db;

    public function __construct($db)
    {
		$this->db = $db;
    }


    /*
     *  public Functions
     */
    public function all()
    {
	    $this->db->query("SELECT 1 FROM online");
	    $this->db->execute();

        return $this->db->rowCount();
    }

    public function selectByIP($ip)
    {
	    $this->db->query("SELECT * FROM online WHERE Ip = :ip AND MemberID = 0");
	    $this->db->bind(":ip", $ip, PDO::PARAM_STR);

	    $this->db->execute();

        if ($this->db->rowCount() > 0)
        {
            $data = $this->db->getResult();
            return new OnlineClass($data);
        }
	    else
	    {
		    return null;
	    }
    }

    public function selectByID($id)
    {
	    $this->db->query("SELECT * FROM online WHERE MemberID = :id");
	    $this->db->bind(":id", $id, PDO::PARAM_INT);

	    $this->db->execute();

        if ($this->db->rowCount() > 0)
        {
            $data = $this->db->getResult();
            return new OnlineClass($data);
        }
        return null;
    }

    public function add(OnlineClass $O)
    {
        $memberID = $O->getMemberID();
        $ip = $O->getIP();

        $this->db->query("INSERT INTO online (MemberID, Ip, InDate, LastDate)
                                    VALUES (:memberID, :ip, NOW(), NOW())");
        $this->db->bind(":memberID", $memberID, PDO::PARAM_INT);
        $this->db->bind(":ip", $ip, PDO::PARAM_STR);

        $this->db->execute();
    }

    public function updateByID(OnlineClass $On)
    {
        $memberID = $On->getMemberID();

	    $this->db->query("UPDATE online SET LastDate = NOW() WHERE MemberID = $memberID");
	    $this->db->execute();
    }

    public function updateByIP(OnlineClass $On)
    {
        $ip = $On->getIP();

	    $this->db->query("UPDATE online SET LastDate = NOW() WHERE Ip = :ip");
	    $this->db->bind(":ip", $ip, PDO::PARAM_STR);
	    $this->db->execute();
    }

    public function delete()
    {
	    $this->db->query("DELETE FROM online WHERE LastDate < DATE_SUB(NOW(), INTERVAL 15 SECOND)");
	    $this->db->execute();
    }
}