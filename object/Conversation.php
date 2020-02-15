<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 06/02/2016
 * Time: 15:59
 */

namespace App\Objects;

use \Objects\Member;

class Conversation
{
	private $_id;
	private $_status;
	private $_user;                 // Member object
	private $_contact;              // Member object
	private $_dateTimeC;
	private $_dateTimeM;


	public function __construct(array $data)
	{
		$this->build($data);
	}


	/*
	 * Getters
	 */
	public function getConversationID()     { return $this->_id; }
	public function getStatus()             { return $this->_status; }
	public function getUser()               { return $this->_user; }
	public function getContact()            { return $this->_contact; }
	public function getDateTimeC()          { return $this->_dateTimeC; }
	public function getDateTimeM()          { return $this->_dateTimeM; }


	/*
	 * Setters
	 */
	public function setConversationID($id)          { $this->_id = $id; }
	public function setStatus($status)              { $this->_status = $status; }
	public function setUser(Member $member)         { $this->_user = $member; }
	public function setContact(Member $member)      { $this->_contact = $member; }
	public function setDateTimeC($dateTimeC)        { $this->_dateTimeC = $dateTimeC; }
	public function setDateTimeM($dateTimeM)        { $this->_dateTimeM = $dateTimeM; }


	/*
	 * Methods
	 */
	public function build(array $data)
	{
		foreach($data as $key => $value)
		{
			$method = "set" . ucfirst($key);
			if(method_exists($this, $method))
			{
				$this->{$method}($value);
			}
		}
	}
}