<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 09/02/2016
 * Time: 16:44
 */

namespace App\Objects;

use Objects\Member;

class Email
{
	private $_id;
	private $_email;
	private $_member;           // member object
	private $_isDefault;
	private $_isVerified;
	private $_code;


	public function __construct(array $data)
	{
		$this->setEmailID($data['EmailID']);
		$this->setEmail($data['Email']);
		$this->setMember($data['Member']);
		$this->setIsDefault($data['IsDefault']);
		$this->setIsVerified($data['IsVerified']);
		$this->setCode($data['Code']);
	}


	/*
	 * Getters
	 */
	public function getEmailID()
	{
		return $this->_id;
	}
	public function getEmail()
	{
		return $this->_email;
	}
	public function getMember()
	{
		return $this->_member;
	}
	public function getIsDefault()
	{
		return $this->_isDefault == 1;
	}
	public function getIsVerified()
	{
		return $this->_isVerified == 1;
	}
	public function getCode()
	{
		return $this->_code;
	}


	/*
	 * Setters
	 */
	public function setEmailID($id)
	{
		$this->_id = $id;
	}
	public function setEmail($email)
	{
		$this->_email = $email;
	}
	public function setMember(Member $member)
	{
		$this->_member = $member;
	}
	public function setIsDefault($val)
	{
		$this->_isDefault = $val;
	}
	public function setIsVerified($val)
	{
		$this->_isVerified = $val;
	}
	public function setCode($code)
	{
		$this->_code = $code;
	}
}