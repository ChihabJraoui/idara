<?php

namespace App\Object;



class Forum
{
    private $catID;

    private $forumID;

    private $status;

    private $name;

    private $description;

    private $order;

    private $_icon;

    private $sex;

    private $hide;

    private $level;

    private $_lastPostDate;


    public function __construct(array $data)
    {
		$this->Build($data);
    }


    /*
     * Getters
     */
    public function getCatID()				{ return $this->catID;}
    public function getForumID()			{ return $this->forumID;}
    public function getStatus()				{ return $this->status;}
    public function getName()				{ return $this->name;}
    public function getDescription()		{ return $this->description;}
    public function getForumOrder()			{ return $this->order;}
    public function getIcon()               { return $this->_icon; }
    public function getSex()				{ return $this->sex;}
    public function getHide()				{ return $this->hide;}
    public function getLevel()				{ return $this->level;}
	public function getLastPostDate()       { return $this->_lastPostDate; }

	public function getIconLink()
	{
		return \Config::ImagesFolder . 'forum/' . $this->_icon;
	}


    /*
     * Setters
     */
    public function setCatID($id)				{ $this->catID = $id;}
    public function setForumID($id)				{ $this->forumID = $id;}
    public function setStatus($status)			{ $this->status = $status;}
    public function setName($val)				{ $this->name = $val;}
    public function setDescription($val)		{ $this->description = $val;}
    public function setForumOrder($val)			{ $this->order = $val;}
    public function setIcon($val)				{ $this->_icon = $val;}
    public function setSex($val)				{ $this->sex = $val;}
    public function setHide($val)				{ $this->hide = $val;}
    public function setLevel($val)				{ $this->level = $val;}
    public function setLastPostDate($val)		{ $this->_lastPostDate = $val; }


    /*
     * Methodes
     */
    private function Build(array $data)
    {
        foreach($data as $key => $value)
        {
	        $key = ucfirst($key);
            $method = "set".$key;
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
	
	public function getSexLabel()
	{
		if($this->sex == "F")
		{
			return'
			<span class="label label-default">أنثي</span>';
		}
		elseif($this->sex == "M")
		{
			return'
			<span class="label label-default">ذكر</span>';
		}
		elseif($this->sex == "A")
		{
			return'
			<span class="label label-default">الجميع</span>';
		}
	}

	public function getHideLabel()
	{
		if($this->hide == 1)
		{
			return'
			<span class="label label-warning">نعم</span>';
		}
		elseif($this->hide == 0)
		{
			return'
			<span class="label label-success">لا</span>';
		}
	}

	public function getLevelLabel()
	{
		if($this->level == 0)
		{
			return'
			<span class="label label-primary">الجميع</span>';
		}
		elseif($this->level == 1)
		{
			return'
			<span class="label label-default">الأعضاء</span>';
		}
		elseif($this->level == 2)
		{
			return'
			<span class="label label-danger">المشرفون</span>';
		}
		elseif($this->level == 3)
		{
			return'
			<span class="label label-warning">المراقبون</span>';
		}
		elseif($this->level == 4)
		{
			return'
			<span class="label label-info">المدراء</span>';
		}
	}
}