<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 09/02/2016
 * Time: 13:57
 */

namespace App\Object;



class Photo
{

	protected $_id;

    protected $_member;

    protected $_photoName;

    protected $_dateTimeC;



	public function __construct(array $data)
	{
		$this->setPhotoID($data['PhotoID']);
		$this->setMember($data['Member']);
		$this->setName($data['Name']);
		$this->setDateTimeC($data['DateTimeC']);
	}



	/*
	 * Getters
	 */
	public function getPhotoID()
	{
		return $this->_id;
	}
	public function getMember()
	{
		return $this->_member;
	}
	public function getName()
	{
		return $this->_photoName;
	}
	public function getDateTimeC()
	{
		return $this->_dateTimeC;
	}

	public function getLink()
	{
		return 'users/' . $this->_photoName;
	}



	/*
	 * Setters
	 */
	public function setPhotoID($id)
	{
		$this->_id = $id;
	}
	public function setMember(Member $member = null)
	{
		$this->_member = $member;
	}
	public function setName($name)
	{
		$this->_photoName = $name;
	}
	public function setDateTimeC($datetime)
	{
		$this->_dateTimeC = $datetime;
	}

}