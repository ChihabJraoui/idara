<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 09/02/2016
 * Time: 15:31
 */

namespace App\Objects;

class Cover extends Photo
{
	public function __construct(array $data)
	{
		parent::__construct($data);
	}
	

	/*
	 * Getters
	 */
	public function getName()
	{
		return $this->_photoName;
	}

	public function getLink()
	{
		return \Config::ImagesFolder . 'covers/' . $this->_photoName;
	}
}