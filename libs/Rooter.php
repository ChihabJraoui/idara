<?php

namespace Idara;

use User;
use Func;


/*
 * Rooter Class
 */

class Rooter
{
    private $controller;
    private $function;
    private $params;
    private $ajaxRequest;

    public function __construct()
    {
        // set ajax request flag
        if(filter_input(INPUT_POST, "ajax"))
        {
            $this->ajaxRequest = true;
        }
        else
        {
            $this->ajaxRequest = false;
        }


        // test if user is logged in
	    if(User::isLoggedIn() OR $this->ajaxRequest)
	    {
		    $url = Func::parseUrl();

		    $this->setController($url["controller"]);
		    $this->setFunction($url["function"]);
		    $this->setParams($url["params"]);
	    }
	    else
	    {
		    $this->setController("Login");
		    $this->setFunction("index");
	    }
    }


	/*
	 * Setters
	 */
	private function setController($value)
	{
		switch($value)
		{
			case "":                    $ctrl = "Index"; break;
			case "categories":          $ctrl = 'Category'; break;
			case "forums":              $ctrl = 'Forum'; break;

			default:                    $ctrl = $value;
		}

        $this->controller = ucfirst($ctrl);
	}
	private function setFunction($value)
	{
		switch ($value)
		{
			case "":                $this->function = 'index'; break;
			case "i":               $this->function = 'index'; break;
			case "new-topic":       $this->function = 'newTopic'; break;
			case "edit-topic":      $this->function = 'editTopic'; break;

			default:                $this->function = $value;
		}
	}
	private function setParams($value)
	{
		$this->params = $value;
	}


	/*
	 * Getters
	 */
	public function getController()
	{
		if($this->ajaxRequest == true)
		{
			return 'Ajax\\' . $this->controller;
		}
		else
		{
			return $this->controller;
		}
	}

	public function getFunction()
	{
		return $this->function;
	}

	public function getParams()
	{
		return $this->params;
	}


    /*
     * Functions
     */
    public function getControllerFile()
    {
	    if($this->ajaxRequest == true)
	    {
		    return 'ajax/' . $this->controller . '.php';
	    }
	    else
	    {
		     return 'controllers/' . $this->controller . '.php';
	    }
    }
}