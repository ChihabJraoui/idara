<?php

namespace Objects;

class Category
{
    private $catID;
    private $status;
    private $name;
    private $catOrder;
    private $hide;
    private $level;

    public function __construct(array $data)
    {
        $this->Build($data);
    }

    /* Properties */
	public function getCatID()
	{
		return $this->catID;
	}
    public function getStatus()     	{ return $this->status; }
    public function getName() 		    { return $this->name; }
    public function getCatOrder()   	{ return $this->catOrder; }
    public function getHide() 	    	{ return $this->hide; }
    public function getLevel() 	    	{ return $this->level; }

    public function setCatID($id)	    { $this->catID = $id;}
    public function setStatus($status)	{ $this->status = $status;}
    public function setName($name)  	{ $this->name = $name;}
    public function setCatOrder($val)	{ $this->catOrder = $val;}
    public function setHide($hide)	    { $this->hide = $hide;}
    public function setLevel($level)	{ $this->level = $level;}

    /* Methodes */
    private function Build(array $data)
    {
        foreach($data as $key => $value)
        {
	        $key = ucfirst($key);
            $method = 'set' . $key;
            if(method_exists($this, $method))
            {
                    $this->$method($value);
            }
        }
    }
}