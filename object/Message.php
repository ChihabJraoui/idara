<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 21/12/2015
 * Time: 12:25
 */

namespace Objects;

use \App\Objects\Conversation;

class Message
{
	private $_id;
	private $_conversation;
	private $_status;
	private $_author;
	private $_content;
	private $_dateSend; // timestamp
	private $_seen;
	private $_dateSeen;


	public function __construct(array $data)
	{
		$this->build($data);
	}


	/*
	 * Getters
	 */
	public function getMessageID()          { return $this->_id; }
	public function getConversation()       { return $this->_conversation; }
	public function getStatus()             { return $this->_status; }
	public function getAuthor()             { return $this->_author; }
	public function getContent()            { return $this->_content; }
	public function getDateSend()           { return $this->_dateSend; }
	public function getSeen()               { return $this->_seen; }
	public function getDateSeen()           { return $this->_dateSeen; }


	/*
	 * Setters
	 */
	public function setMessageID($val)                      { $this->_id = $val; }
	public function setConversation(Conversation $val = null)      { $this->_conversation = $val; }
	public function setStatus($val)                         { $this->_status = $val; }
	public function setAuthor(Member $val)                  { $this->_author = $val; }
	public function setContent($val)                        { $this->_content = $val; }
	public function setDateSend($val)                       { $this->_dateSend = $val; }
	public function setSeen($val)                           { $this->_seen = $val; }
	public function setDateSeen($val)                       { $this->_dateSeen = $val; }


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