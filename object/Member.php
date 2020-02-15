<?php

/*
 * Member Object Class.
 */

namespace App\Object;



use Config;



class Member
{

	/*
	 * Fields
	 */

    private $_id;

    private $_status;

    private $_fname;

    private $_lname;

    private $_pseudo;

    private $_password;

    private $_email;

    private $_country;

    private $_level;

    private $_points;

    private $_registerDate;

    private $_timezone;

    private $_receiveEmail;

    private $_lastIP;

    private $_ip;

    private $_sex;

    private $_birthDay;

    private $_bio;

    private $_city;

    private $_state;

    private $_title;

    private $_oldMod;

    private $_changeName;

    private $_browse;

    private $_locked;

    private $_hideTopics;

    private $_hidePosts;

	private $_photo;

    private $_cover;



    // Constructor
    public function __construct(array $data)
    {
        $this->Fill($data);
    }


    /*
     * Getters
     */
    public function getMemberID()           { return $this->_id; }
    public function getStatus()             { return $this->_status; }
    public function getPseudo()             { return $this->_pseudo; }
    public function getName()               { return $this->_fname . " " . $this->_lname; }
    public function getFName()              { return $this->_fname; }
    public function getLName()              { return $this->_lname; }
	public function getPassword()           { return $this->_password; }
    public function getEmail()              {
        return $this->_email;
    }

    public function getCountry()
    {
        return $this->_country;
    }

    public function getLevel()
    {
        return $this->_level;
    }

    public function getPoints()
    {
        return $this->_points;
    }

    public function getRegisterDate()
    {
        return $this->_registerDate;
    }

    public function getTimeZone()
    {
        return $this->_timezone;
    }

    public function getReceiveEmail()
    {
        return $this->_receiveEmail;
    }

    public function getLastIP()
    {
        return $this->_lastIP;
    }

    public function getIP()
    {
        return $this->_ip;
    }

    public function getSex($flag = FALSE)
    {
	if($flag)
	{
	    if($this->_sex == 'M')
	    {
		return 'ذكر';
	    }
	    else
	    {
		return 'أنثى';
	    }
	}
        return $this->_sex;
    }

    public function getBirthDay()
    {
        return $this->_birthDay;
    }

    public function getBio()
    {
        return $this->_bio;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function getPhoto()
    {
        return $this->_photo;
    }

	public function getCover()
	{
		return $this->_cover;
	}

    public function getTitle()
    {
        return $this->_title;
    }

    public function getOldMod()
    {
        return $this->_oldMod;
    }

    public function getChangeName()
    {
        return $this->_changeName;
    }

    public function getBrowse()                     { return $this->_browse; }
    public function getLocked()                     { return $this->_locked; }
    public function getHideTopics()                 { return $this->_hideTopics; }
    public function getHidePosts()                  { return $this->_hidePosts; }


	/*
	 * Setters
	 */
    public function setMemberID($val)
    {
        $this->_id = $val;
    }

    public function setStatus($val)
    {
        $this->_status = $val;
    }

    public function setPseudo($val)
    {
        $this->_pseudo = $val;
    }

    public function setFName($val)
    {
        $this->_fname = $val;
    }

    public function setLName($val)
    {
        $this->_lname = $val;
    }

    public function setPassword($val)
    {
        $this->_password = $val;
    }

    public function setEmail($val)
    {
        $this->_email = $val;
    }

    public function setCountry($val)
    {
        $this->_country = $val;
    }

    public function setLevel($val)
    {
        $this->_level = $val;
    }

    public function setPoints($val)
    {
        $this->_points = $val;
    }

    public function setRegisterDate($val)
    {
        $this->_registerDate = $val;
    }

    public function setTimeZone($val)
    {
        $this->_timezone = $val;
    }

    public function setReceiveEmail($val)
    {
        $this->_receiveEmail = $val;
    }

    public function setLastIP($val)
    {
        $this->_lastIP = $val;
    }

    public function setIP($val)
    {
        $this->_ip = $val;
    }

    public function setSex($val)
    {
        $this->_sex = $val;
    }

    public function setBirthDay($val)
    {
        $this->_birthDay = $val;
    }

    public function setBio($val)
    {
        $this->_bio = $val;
    }

    public function setCity($val)
    {
        $this->_city = $val;
    }

    public function setState($val)
    {
        $this->_state = $val;
    }

    public function setPhoto($val)
    {
        $this->_photo = $val;
    }

	public function setCover($val)
	{
		$this->_cover = $val;
	}

    public function setTitle($val)
    {
        $this->_title = $val;
    }

    public function setOldMod($val)
    {
        $this->_oldMod = $val;
    }

    public function setChangeName($val)
    {
        $this->_changeName = $val;
    }

    public function setBrowse($val)
    {
        $this->_browse = $val;
    }

    public function setLocked($val)
    {
        $this->_locked = $val;
    }

    public function setHideTopics($val)
    {
        $this->_hideTopics = $val;
    }

    public function setHidePosts($val)
    {
        $this->_hidePosts = $val; }


    /*
     * Private Methodes
     */
    protected function Fill(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = "set" . $key;
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


	/*
	 * Public Functions
	 */
	public function getColor()
	{
		$color = "";

		if ($this->getStatus() == 1)
		{
			if ($this->getLevel() == 1)
			{
				$color = "black";
			} elseif ($this->getLevel() == 2)
			{
				$color = "red";
			} elseif ($this->getLevel() == 3)
			{
				$color = "yellow";
			}
		}
		else
		{
			$color = "grey";
		}

		if ($this->getLevel() == 4)
		{
			$color = "blue";
		}

		return $color;
	}

	public function getLevelLabel()
	{
		switch($this->getLevel())
		{
			case 1:     $name = "عضو";
						$color = "black"; break;
			case 2:     $name = "مشرف";
						$color = "crimson"; break;
			case 3:     $name = "مراقب";
						$color = "gold"; break;
			case 4:     $name = "مدير";
						$color = "dodgerBlue"; break;
		}

		return '<span class="label" style="background-color: '. $color .'">'. $name .'</span>';
	}

    public function getProfileLink()
    {
        return Config::getLink("profile") . $this->_id;
    }

	public function getProfile()
	{
		return '
		<div class="profile">
			<a href="'.$this->getProfileLink().'">
            <div class="profile-heading">
                <div class="profile-cover">
                    <img src="' . $this->getCover() . '" />
                </div>
                <div class="profile-photo '. $this->getColor() .'">
					<img src="' . $this->getPhoto() . '" />
                </div>
            </div>
            <div class="profile-footer">
                <span>'. $this->getName() .'</span>
            </div>
            </a>
        </div>';
	}
}