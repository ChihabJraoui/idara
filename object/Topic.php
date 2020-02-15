<?php

namespace Objects;

class Topic
{

    private $forumID;
    private $topicID;
    private $status;
    private $subject;
    private $content;
    private $description;
    private $author;                // Member object
    private $dateC;

	private $_isLocked;
    private $_isHidden;
    private $_isSticky;

    //Constructor
    public function __construct(array $data)
    {
        $this->Fill($data);
    }

    /*
     * Getters
     */
    public function getForumID()
    {
        return $this->forumID;
    }

    public function getTopicID()
    {
        return $this->topicID;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getContent()
    {
        return $this->content;
    }
	public function getDescription()            { return $this->description; }

    public function getAuthor()                 { return $this->author; }

    public function getDateTimeC()
    {
        return $this->dateC;
    }

    public function getIsLocked()           { return $this->_isLocked == 1; }
    public function getIsHidden()           { return $this->_isHidden == 1; }
    public function getIsSticky()           { return $this->_isSticky == 1; }


	/*
	 * Setters
	 */
    public function setForumID($val)		    	{ $this->forumID = $val; }
	public function setTopicID($val)			    { $this->topicID = $val; }
	public function setStatus($val)			        { $this->status = $val; }
	public function setSubject($val)			    { $this->subject = $val; }
	public function setContent($val)			    { $this->content = $val; }
	public function setDescription($val)		    { $this->description = $val; }
	public function setAuthor(Member $member)	    { $this->author = $member; }
	public function setDateTimeC($val)			    { $this->dateC = $val; }

	public function setIsLocked($val)
	{
		if($val == 1)
			$this->_isLocked = 1;
		else
			$this->_isLocked = 0;
	}
	public function setIsHidden($val)
	{
		if($val == 1)
			$this->_isHidden = 1;
		else
			$this->_isHidden = 0;
	}
	public function setIsSticky($val)
	{
		if($val == 1)
			$this->_isSticky = 1;
		else
			$this->_isSticky = 0;
	}
	


    /*
     * Private Functions
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
}