<?php

/*
 * Member Object Class.
 *
 */

namespace App\DAO;



use App\Object\Member as MemberClass;
use App\Object\Photo;

use PDO;



class Member
{
	private $db;

    public function __construct($db)
    {
		$this->db = $db;
    }
    

	/*
     * Private Methodes
     *
     */


	/*
     * Public Methodes
     *
     */
    public function checkPseudo($pseudo)
    {
        $this->db->query("SELECT 1 FROM member WHERE Pseudo = :pseudo");
        $this->db->bind(":pseudo", $pseudo);
        $this->db->execute();

        return $this->db->count() > 0;
    }

    public function checkEmail($email)
    {
        $this->db->query("SELECT 1 FROM member WHERE Email = :email");
        $this->db->bind(":email", $email);
        $this->db->execute();

        return $this->db->count() > 0;
    }

    public function select($memberID)
    {
        $this->db->query("SELECT * FROM member
                          WHERE MemberID = :id
                          OR Pseudo = :id");

        $this->db->bind(":id", $memberID);
        $this->db->execute();

        if ($this->db->count() > 0)
        {
            $data = $this->db->getResult();

            $member = new MemberClass($data);

            $photo = $this->getDefaultPhoto($member);
            $member->setPhoto($photo->getLink());

            return $member;
        }
        else
        {
            return null;
        }
    }

    public function add(MemberClass $Member)
    {
        $fName = $Member->getFName();
        $lName = $Member->getLName();
        $status = $Member->getStatus();
        $pseudo = $Member->getPseudo();
        $password = $Member->getPassword();
        $email = $Member->getEmail();
        $sex = $Member->getSex();
        $birthDay = $Member->getBirthDay();
        $photo = $Member->getPhoto();

        $this->db->query("INSERT INTO member (FName, LName, Status, Pseudo, Password, Email, RegisterDate, Sex, BirthDay, Photo)
                                    VALUES (:fName, :lName, :status, :pseudo, :password, :email, NOW(), :sex, :birthDay, :photo)");
        $this->db->bind(":fName", $fName);
        $this->db->bind(":lName", $lName);
        $this->db->bind(":status", $status, PDO::PARAM_INT);
        $this->db->bind(":pseudo", $pseudo);
        $this->db->bind(":password", $password);
        $this->db->bind(":email", $email);
        $this->db->bind(":sex", $sex);
        $this->db->bind(":birthDay", $birthDay);
        $this->db->bind(":photo", $photo);

	    if ($this->db->execute())
	    {
		    return 1;
	    }
	    else
	    {
		    return $this->db->getError();
	    }
    }

    public function update(MemberClass $m)
    {
        
    }

    public function remove($member_id)
    {
        $this->db->query("UPDATE member SET Status = 0 WHERE MemberID = :id");
        $this->db->bind(":id", $member_id, PDO::PARAM_INT);
        $this->db->execute();
    }




    /*
     * Photos
     */
    public function getDefaultPhoto(MemberClass $member)
    {
        $memberId = $member->getMemberID();

        $this->db->query("SELECT * FROM member_photo
							WHERE MemberID = :memberID AND isDefault = 1");

        $this->db->bind(":memberID", $memberId, PDO::PARAM_INT);
        $this->db->execute();

        if($this->db->count() > 0)
        {
            $row = $this->db->getResult();

            $data = array(
                'PhotoID' => $row['MPID'],
                'Name' => $row['Name'],
                'DateTimeC' => $row['DateTimeC']
            );

            return new Photo($data);
        }
        else
        {
            if($member->getSex() == 'M')
            {
                $photo = new Photo(array(
                    'Name' => '00-male.png',
                ));
            }
            else
            {
                $photo = new Photo(array(
                    'Name' => '00-female.png'
                ));
            }

            return $photo;
        }
    }




    public function isOnline($member_id)
    {
        $this->db->query("SELECT 1 FROM online WHERE MemberID = :id");
        $this->db->bind(":id", $member_id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->count() > 0;
    }
    
    function getNumVisitors()
    {
        $this->db->query("SELECT * FROM online WHERE MemberID = 0");
        $this->db->execute();

        return $this->db->count();
    }
    
    function getOnlinemember()
    {
        $this->db->query("SELECT * FROM online WHERE MemberID != 0");
	    $this->db->execute();

        $member = array();
        $rows = $this->db->getResults();

	    foreach($rows as $row)
        {
            $member[] = $this->select($row['MemberID']);
        }

        return $member;
    }
    
    function getFollowers($memberID)
    {
        $this->db->query("SELECT * FROM followers WHERE MemberID = :mID");
        $this->db->bind(":mID", $memberID, PDO::PARAM_INT);
        $this->db->execute();
        
        $member = array();

        if($this->db->count() > 0)
        {
            $rows = $this->db->getResults();
            foreach($rows as $row)
            {
                $mem = $this->select($row['FollowerID']);
                if($mem !== null)
                {
                    $member[] = $mem;
                }
            }
        }

        return $member;
    }



    /*
     * Search
     */
    public function search($word)
    {
        $word = '%' . $word . '%';

        $this->db->query("SELECT * FROM member
						  WHERE Pseudo LIKE :word
						  OR FName LIKE :word
						  OR LName LIKE :word");

        $this->db->bind(":word", $word);
        $this->db->execute();

        $member = array();

        if($this->db->count() > 0)
        {
            $rows = $this->db->getResults();
            foreach($rows as $row)
            {
                $member[] = $this->select($row['MemberID']);
            }
        }

        return $member;
    }




    /*
     *    STATISTICS
     */

    public function nummember()
    {
        $this->db->query("SELECT * FROM member WHERE Status = 1");
        $this->db->execute();

        return $this->db->count();
    }

    public function numLockedmember()
    {
        $this->db->query("SELECT * FROM member WHERE Status = 0");
        $this->db->execute();

        return $this->db->count();
    }



    // Visitors' Statistics
    public function getNewVisitors()
    {
        $month = date("m");
        $this->db->query("SELECT * FROM website_visitors WHERE MONTH(DateTimeC) = $month");
        $this->db->execute();

        return $this->db->count();
    }
    public function getOldVisitors()
    {
        $month = date("m");
        $month = $month - 1;
        $this->db->query("SELECT * FROM website_visitors WHERE MONTH(DateTimeC) = $month");
        $this->db->execute();

        return $this->db->count();
    }

    public function getmemberLevels()
    {
        $this->db->query("SELECT Level, COUNT(MemberID) as 'MemberCount' FROM member
                          GROUP BY Level");
        $this->db->execute();

        $rows = $this->db->getResults();
        $data = array();

        for($i = 0; $i < 4; $i++)
        {
            if($i + 1 == 1)
                $data['label'][] = 'الأعضاء';
            elseif($i + 1 == 2)
                $data['label'][] = 'المشرفون';
            elseif($i + 1 == 3)
                $data['label'][] = 'المراقبون';
            elseif($i + 1 == 4)
                $data['label'][] = 'المديرون';

            $data['data'][] = 0;
        }

        foreach($rows as $row)
        {
            $level = $row['Level'];

            $data['data'][$level - 1] = intval($row['MemberCount']);
        }

        return $data;
    }

    public function getLockedmember()
    {
        $this->db->query("SELECT Status, COUNT(MemberID) as 'MemberCount' FROM member
                          GROUP BY Status");
        $this->db->execute();

        $rows = $this->db->getResults();
        $data = array();

        $data['label'][0] = 'عضويات مقفولة';
        $data['label'][1] = 'عضويات مفتوحة';

        $data['data'][0] = 0;
        $data['data'][1] = 0;

        foreach($rows as $row)
        {
            $status = $row['Status'];

            $data['data'][$status] = intval($row['MemberCount']);
        }

        return $data;
    }

    public function selectLastRegistred($count = 10)
    {
        $this->db->query("SELECT MemberID FROM member
                          ORDER BY DatetimeRegister DESC LIMIT :count");

        $this->db->bind(":count", $count);
        $this->db->execute();

        $members = array();

        if ($this->db->count() > 0)
        {
            $rows = $this->db->getResults();

            foreach($rows as $row)
            {
                $members[] = $this->select($row['MemberID']);
            }
        }

        return $members;
    }
}