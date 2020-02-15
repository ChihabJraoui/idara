<?php

namespace Objects;

use \DAO\Member as MemberDAO;
use \DAO\Reply as ReplyDAO;
use \DAO\Topic as TopicDAO;

class Notification
{
	private $notificationID;

	private $authorID;

	private $memberID;

	private $objectID;                      //Topic, Comment, Message

	private $type;                          /* 1 => Topic, 2 => Comment, 3 => Message, 4 => Follower */

	private $seen;

	private $dateTimeSeen;

	private $dateTimeC;


	const TYPE_TOPIC = 1;
	const TYPE_COMMENT = 2;
	const TYPE_MESSAGE = 3;
	const TYPE_FOLLOW = 4;

	/*
	 * Constructor
	 */
	public function __construct($data)
	{
		$this->build($data);
	}



	/*
	 * Getters
	 */
	public function getNotificationID() 		{ return $this->notificationID; }
	public function getAuthorID() 				{ return $this->authorID; }
	public function getMemberID() 				{ return $this->memberID; }
	public function getObjectID() 				{ return $this->objectID; }
	public function getType() 					{ return $this->type; }
	public function getSeen() 					{ return $this->seen; }
	public function getDateTimeSeen() 			{ return $this->dateTimeSeen; }
	public function getDateTimeC() 				{ return $this->dateTimeC; }



	/*
	 * Setters
	 */
	public function setNotificationID($val) 	    { $this->notificationID = $val; }
	public function setAuthorID($val) 	            { $this->authorID = $val; }
	public function setMemberID($val) 	            { $this->memberID = $val; }
	public function setObjectID($object) 			{ $this->objectID = $object; }
	public function setType($val) 				    { $this->type = $val; }
	public function setSeen($val) 				    { $this->seen = $val; }
	public function setDateTimeSeen($val) 			{ $this->dateTimeSeen = $val; }
	public function setDateTimeC($val) 				{ $this->dateTimeC = $val; }



	/*
	 * Functions
	 */
	private function build(array $data)
	{
		foreach($data as $key => $value)
		{
			$method = "set" . ucfirst($key);

			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function getMessage($db)
	{
		$memberDAO = new MemberDAO($db);

		$author = $memberDAO->select($this->getAuthorID());
		$member = $memberDAO->select($this->getMemberID());

		$message = "";
		$link = "";
		$objectTitle = "";

		if($this->getType() == self::TYPE_TOPIC)
		{
			$topicDAO = new TopicDAO($db);
			$topic = $topicDAO->select(TopicDAO::TYPE_TOPIC, $this->getObjectID());

			$link = \Config::getLink("TopicLink") . $this->getObjectID();
			$message = " قام بإضافة موضوع جديد : ";
			$objectTitle = $topic->getSubject();
		}
		elseif($this->getType() == self::TYPE_COMMENT)
		{
			$replyDAO = new ReplyDAO($db);
			$topicDAO = new TopicDAO($db);

			$reply = $replyDAO->getReply($this->getObjectID());
			$topic = $topicDAO->select(TopicDAO::TYPE_TOPIC, $reply->getTopicID());

			$link = \Config::getLink("TopicLink") . $reply->getTopicID();
			$message = " قام بالرد على موضوعك : ";
			$objectTitle = $topic->getSubject();
		}
		elseif($this->getType() == self::TYPE_FOLLOW)
		{
			$link = \Config::getLink("ProfileLink") . $member->getMemberID() . '?section=followers';
			$message = " يتابعك حاليا";
		}

		//return '
		//	<a href="'. $link .'">
		//		'. $author->getProfileCircle(40) . ' ' . $author->getName() . $message . $objectTitle .'
		//	</a>';

		return $this->dateTimeC;
	}
}

class NotificationCollection
{
	private $notifications;

	public function __construct()
	{
		$this->notifications = array();
	}

	public function add(array $notification)
	{
		$this->notifications[] = $notification;
	}

	public function get($i)
	{
		return new Notification($this->notifications[$i]);
	}

	public function getCount()
	{
		return count($this->notifications);
	}
}