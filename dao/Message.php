<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 21/12/2015
 * Time: 12:13
 */

namespace DAO;

use \PDO;
use \PDOException;

class Message
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getConversations($memberID)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT * FROM conversations WHERE (Member1ID = :mID OR Member2ID = :mID)
			AND Status = 1 ORDER BY DateM DESC");
			$stmt->bindParam(":mID", $memberID, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}

		if($stmt->rowCount() > 0)
		{
			$rows = $stmt->fetchAll();
			return $rows;
		}
		else
		{
			return null;
		}
	}

	public function getLastMessage($convID)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT * FROM messages WHERE ConversationID = :convID
								ORDER BY DateSend DESC LIMIT 1");
			$stmt->bindParam(":convID", $convID, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}

		if($stmt->rowCount() > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$message = new \Objects\Message($row);
			return $message;
		}
		else
		{
			return null;
		}
	}

	public function messageCount($mID)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT 1 FROM messages m INNER JOIN conversations c
										ON(m.ConversationID = c.ConversationID)
										WHERE (c.Member1ID = :mID OR c.Member2ID = :mID) AND m.Seen = 0 AND m.MemberID != :mID
										GROUP BY c.ConversationID");
			$stmt->bindParam(":mID", $mID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->rowCount();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function markAsRead($mID, $contactID)
	{
		try
		{
			$stmt = $this->db->prepare("UPDATE messages m INNER JOIN conversations c ON (m.ConversationID = c.conversationID)
										SET Seen = 1, DateSeen = NOW()
										WHERE ((c.Member1ID = :mID AND c.Member2ID = :cID) OR (c.Member1ID = :cID AND c.Member2ID = :mID))
										AND m.MemberID != :mID AND m.Seen = 0");
			$stmt->bindParam(":mID", $mID, PDO::PARAM_INT);
			$stmt->bindParam(":cID", $contactID, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function fetchData($memberID, $contactID)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT * FROM conversations c RIGHT JOIN messages m
			ON(c.ConversationID = m.ConversationID)
			WHERE (Member1ID = :memberID AND Member2ID = :contactID)
			OR (Member1ID = :contactID AND Member2ID = :memberID)
			AND m.Status = 1 ORDER BY m.DateSend ASC");

			$stmt->bindParam(":memberID", $memberID, PDO::PARAM_INT);
			$stmt->bindParam(":contactID", $contactID, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}

		$messages = [];
		if($stmt->rowCount() > 0)
		{
			$rows = $stmt->fetchAll();
			foreach($rows as $row)
			{
				$messages[] = new \Objects\Message($row);
			}
		}
		return $messages;
	}

	public function fetchNewData($memberID, $contactID, $datetime)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT * FROM conversations c INNER JOIN messages m
			ON(c.ConversationID = m.ConversationID)
			WHERE ((c.Member1ID = :memberID AND c.Member2ID = :contactID)
			OR (c.Member1ID = :contactID AND c.Member2ID = :memberID))
			AND m.DateSend > :datetime ORDER BY m.DateSend ASC");

			$stmt->bindParam(":memberID", $memberID, PDO::PARAM_INT);
			$stmt->bindParam(":contactID", $contactID, PDO::PARAM_INT);
			$stmt->bindParam(":datetime", $datetime, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}

		$messages = [];

		if($stmt->rowCount() > 0)
		{
			$rows = $stmt->fetchAll();
			foreach($rows as $row)
			{
				$messages[] = new \Objects\Message($row);
			}
		}

		return $messages;
	}
}