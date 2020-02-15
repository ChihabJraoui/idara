<?php

namespace App\Object;



use App\DAO\Member as MemberDAO;



class Reply
{
    private $_forumID;
    private $_topicID;
    private $_replyID;
    private $_status;
    private $_content;
    private $_author;
    private $_dateC;
    private $_lastEditDate;
    private $_hidden;

    public function __construct(array $data)
    {
        $this->Fill($data);
    }

    /*
     * Getters
     *
     * */
    public function getForumID()        { return $this->_forumID; }
    public function getTopicID()
    {
        return $this->_topicID;
    }

    public function getReplyID()
    {
        return $this->_replyID;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getAuthorID()
    {
        return $this->_author;
    }

    public function getDateC()
    {
        return $this->_dateC;
    }

    public function getHidden()
    {
        return $this->_hidden;
    }

    public function getLastEditDate()
    {
        return $this->_lastEditDate;
    }


    /*
     * Setters
     *
     * */
    public function setForumID($val)            { $this->_forumID = $val; }
    public function setTopicID($val)            { $this->_topicID = $val; }

    public function setReplyID($val)
    {
        $this->_replyID = $val;
    }

    public function setStatus($val)
    {
        $this->_status = $val;
    }

    public function setContent($val)
    {
        $this->_content = $val;
    }

    public function setAuthor($val)
    {
        $this->_author = $val;
    }

    public function setDateC($val)
    {
        $this->_dateC = $val;
    }

    public function setHidden($val)
    {
        $this->_hidden = $val;
    }

    public function setLastEditDate($val)
    {
        $this->_lastEditDate = $val;
    }


    /*
     * Private Methods
     */
    private function Fill(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


	/*
	 * Public Functions
	 */
	public function getAuthor($db)
	{
		$memberDAO = new MemberDAO($db);

		return $memberDAO->select($this->_author);
	}
}
