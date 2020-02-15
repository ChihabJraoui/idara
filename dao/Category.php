<?php

/*
 * Data Access Object : Category
 */

namespace DAO;



use Objects\Category as CategoryClass;
use App\Object\Forum as ForumClass;

use PDO;



class Category
{
	private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /* 
     * Private Methodes
     */
    private function getCatOrder()
    {
        $this->db->query("SELECT CatOrder FROM category ORDER BY CatOrder DESC LIMIT 1");
        $this->db->execute();

	    if($this->db->count() > 0)
        {
            $r = $this->db->getResult();
            $catOrder = $r["CatOrder"];
        }
        else
        {
            $catOrder = 1;
        }
        return $catOrder;
    }

    /*
     * Methodes
     */
    public function selectAll()
    {
        $Cats = array();

	    $this->db->query("SELECT * FROM category ORDER BY CatOrder ASC");
	    $this->db->execute();

        $rows = $this->db->getResults();
        foreach($rows as $row)
        {
                $Cats[] = new CategoryClass($row);
        }
        return $Cats;
    }
	
    public function select($id)
    {
        $this->db->query("SELECT * FROM category WHERE CatID = $id");
        $this->db->execute();

        if($this->db->count() > 0)
        {
            $data = $this->db->getResult();
            return new CategoryClass($data);
        }
        else
        {
            return null;
        }
    }

    public function selectForums(CategoryClass $cat)
    {
        $catId = $cat->getCatID();

        $this->db->query("SELECT * FROM forum
                          WHERE CatID = :id
                          ORDER BY ForumOrder");

        $this->db->bind(":id", $catId, PDO::PARAM_INT);
        $this->db->execute();

        $forums = array();

        if($this->db->count() > 0)
        {
            $rows = $this->db->getResults();
            foreach($rows as $row)
            {
                $forums[] = new ForumClass($row);
            }
        }

        return $forums;
    }
	
    public function add(CategoryClass $Cat)
    {
        $name = $Cat->getName();
        $hide = $Cat->getHide();
        $level = $Cat->getLevel();

        /* Increment Cats Order */
        $catOrder = $this->getCatOrder();

        $this->db->query("INSERT INTO category (Name, CatOrder, Hide, Level)
                          VALUES(:name, :order, :hide, :level)");
        
        $this->db->bind(":name", $name, PDO::PARAM_STR);
        $this->db->bind(":order", $catOrder, PDO::PARAM_INT);
        $this->db->bind(":level", $level, PDO::PARAM_INT);
        $this->db->bind(":hide", $hide, PDO::PARAM_INT);

	    return $this->db->execute();
    }
	
    public function delete($id)
    {
        $this->db->query("DELETE FROM category WHERE CatID = $id");

        return $this->db->execute();
    }
	
    public function update(CategoryClass $Cat)
    {
        $id = $Cat->getCatID();
        $status = $Cat->getStatus();
        $name = $Cat->getName();
        $hide = $Cat->getHide();
        $level = $Cat->getLevel();

        $this->db->query("UPDATE category SET Status = :status, Name = :name, Hide = :hide,
									Level = :level WHERE CatID = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->bind(":status", $status, PDO::PARAM_INT);
        $this->db->bind(":name", $name, PDO::PARAM_STR);
        $this->db->bind(":hide", $hide, PDO::PARAM_INT);
        $this->db->bind(":level", $level, PDO::PARAM_INT);

	    return $this->db->execute();
    }

    public function updateOrder($idArray, $orderArray)
    {
        $errors = 0;

        for($i = 0; $i < count($idArray); $i++)
        {
            $catID = $idArray[$i];
            $order = $orderArray[$i];

            $this->db->query("UPDATE category SET CatOrder = :catOrder  WHERE CatID = :id");
            $this->db->bind(":id", $catID, PDO::PARAM_INT);
            $this->db->bind(":catOrder", $order, PDO::PARAM_INT);

            if (!$this->db->execute())
            {
                $errors++;
            }
        }

        return $errors == 0;
    }
}