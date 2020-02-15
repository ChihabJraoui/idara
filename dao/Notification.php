<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 10/13/2015
 * Time: 1:22 PM
 */

namespace DAO;

use Objects\Notification as NotificationClass;
use Objects\Member as MemberClass;
use \PDOException;
use \PDO;

class Notification
{
	public function __construct()
	{
		parent::__construct();
	}

	public function Add(NotificationClass $N, MemberClass $M = null)
	{
		$memberID = $N->getMemberID();
		$objectID = $N->getObjectID();
		$type = $N->getType();

		try
		{
			$stmt = $this->pdo->prepare("INSERT INTO notifications (MemberID, ObjectID, Type, DateC)
										VALUES(:memberID, :objectID, :type, NOW())");
			$stmt->bindParam(":memberID", $memberID);
			$stmt->bindParam(":objectID", $objectID);
			$stmt->bindParam(":type", $type);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}

		$notifiID = $this->pdo->lastInsertId();
		$N->setNotificationID($notifiID);

		/* Notify Members */
		if($M == null)
		{
			$this->notifyFollowers($N);
		}
		else
		{
			$this->notifyMember($N, $M);
		}
	}

	public function isSeen($notiID, $memberID)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT 1 FROM notify_members WHERE FollowerID = $memberID
								AND NotificationID = $notiID AND Seen = 1");
			$stmt->execute();
			return $stmt->rowCount() > 0;
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function notificationCount($id)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT 1 FROM notify_members WHERE FollowerID = :id AND Seen = 0");
			$stmt->bindParam(":id", $id);
			$stmt->execute();

			return $stmt->rowCount();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function getNotifications($id)
	{
		try
		{
			$stmt = $this->pdo->prepare("SELECT * FROM notify_members WHERE FollowerID = :id
									ORDER BY DateC DESC");
			$stmt->bindParam(":id", $id);
			$stmt->execute();

			if($stmt->rowCount() > 0)
			{
				$data = array();

				$rows = $stmt->fetchAll();
				foreach($rows as $row)
				{
					$stmt2 = $this->pdo->prepare("SELECT * FROM notifications WHERE NotificationID = :notifiID");
					$stmt2->bindParam(":notifiID", $row["NotificationID"]);
					$stmt2->execute();

					if($stmt2->rowCount() > 0)
					{
						$r2 = $stmt2->fetch(PDO::FETCH_ASSOC);
						$notifi = new NotificationClass($r2);
						$data[] = $notifi;
					}
				}
				return $data;
			}
			return null;
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function markAsRead($id)
	{
		try
		{
			$stmt = $this->pdo->prepare("UPDATE notify_members SET Seen = 1, DateSeen = NOW()
									WHERE FollowerID = :id");
			$stmt->bindParam(":id", $id);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function clearAll($id)
	{
		try
		{
			$stmt = $this->pdo->prepare("DELETE FROM notify_members WHERE FollowerID = :id");
			$stmt->bindParam(":id", $id);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	private function notifyFollowers(NotificationClass $N)
	{
		$notificationID = $N->getNotificationID();
		$memberID = $N->getMemberID();

		try
		{
			$stmt = $this->pdo->prepare("SELECT * FROM followers WHERE MemberID = :memberID");
			$stmt->bindParam(":memberID", $memberID);
			$stmt->execute();

		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}

		if($stmt->rowCount() > 0)
		{
			$rows = $stmt->fetchAll();
			foreach($rows as $row)
			{
				$followerID = $row["FollowerID"];

				$stmt = $this->pdo->prepare("INSERT INTO notify_members (NotificationID, FollowerID, DateC)
											VALUES (:notificationID, :followerID, NOW())");
				$stmt->bindParam(":notificationID", $notificationID);
				$stmt->bindParam(":followerID", $followerID);
				$stmt->execute();
			}
		}
	}

	private function notifyMember(NotificationClass $N, MemberClass $M)
	{
		$notifiID = $N->getNotificationID();
		$member2ID = $M->getMemberID();

		try
		{
			$stmt = $this->pdo->prepare("INSERT INTO notify_members (NotificationID, FollowerID, DateC)
									VALUES (:notificationID, :member2ID, NOW())");
			$stmt->bindParam(":notificationID", $notifiID);
			$stmt->bindParam(":followerID", $member2ID);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
}