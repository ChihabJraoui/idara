<?php

namespace App\Objects;

use \Objects\Member;

class Online
{
    private $_onlineID;
    private $_member;
	private $_ip;                   // for visitors
    private $_dateTimeIn;
    private $_dateTimeLast;


    public function __construct(array $data)
    {
        $this->Fill($data);
    }


    /*
     * Getters
     */
    public function getOnlineID()
    {
        return $this->_onlineID;
    }

    public function getMember()
    {
        return $this->_member;
    }

	public function getIP()
	{
		return $this->_ip;
	}

    public function getDateTimeIn()
    {
        return $this->_dateTimeIn;
    }

    public function getDateTimeLast()
    {
        return $this->_dateTimeLast;
    }


	/*
	 * Setters
	 */
    public function setOnlineID($val)
    {
        $this->_onlineID = $val;
    }

    public function setMember(Member $member)
    {
        $this->_member = $member;
    }

	public function setIP($val)
	{
		$this->_ip = $val;
	}

    public function setDateTimeIn($val)
    {
        $this->_dateTimeIn = $val;
    }

    public function setDateTimeLast($val)
    {
        $this->_dateTimeLast = $val;
    }


    /*
     * Private Methodes
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
