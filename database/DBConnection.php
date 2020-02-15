<?php

/*
 * 
 * Database Connection Class.
 */

class DBConnection
{

    private $pdo;

    private $stmt;

    private $error;



    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DBNAME = "forum";



    public function __construct()
    {
	    $connectionString = "mysql:host=".self::HOST."; dbname=".self::DBNAME;

	    $options = array(
		    PDO::ATTR_PERSISTENT => true,
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	    );

	    try
	    {
		    $this->pdo = new PDO($connectionString, self::USER, self::PASSWORD, $options);
	    }
	    catch(PDOException $e)
	    {
		    $this->error = $e->getMessage();
	    }
    }


	/*
	 * Getters
	 */
	public function getError()
	{
		return "Error: " . $this->error;
	}


	public function query($string)
	{
		$this->stmt = $this->pdo->prepare($string);
	}

	public function bind($param, $value, $type = null)
	{
		if(is_null($type))
		{
			switch(true)
			{
				case is_numeric($value):    $type = PDO::PARAM_INT; break;
				case is_bool($value):       $type = PDO::PARAM_BOOL; break;
				case is_null($value):       $type = PDO::PARAM_NULL; break;

				default:                    $type = PDO::PARAM_STR;
			}
		}

		$this->stmt->bindParam($param, $value, $type);
	}

	public function execute()
	{
        return $this->stmt->execute();
	}

	public function getResults()
	{
		return $this->stmt->fetchAll();
	}

	public function getResult()
	{
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function count()
	{
		return $this->stmt->rowCount();
	}

	public function lastID()
	{
		return $this->pdo->lastInsertId();
	}

	public function beginTransaction()
	{
		return $this->pdo->beginTransaction();
	}

	public function endTransaction()
	{
		return $this->pdo->commit();
	}

	public function cancelTransaction()
	{
		return $this->pdo->rollBack();
	}

	public function debugDumpParams()
	{
		return $this->stmt->debugDumpParams();
	}
}