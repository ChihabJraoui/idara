<?php

/*
 * View Class, Manage Views.
 */

class View
{
	private $data;
    private $jsFiles; // array for javascript files.

    public function __construct()
    {
        $this->data = array();
        $this->jsFiles = array();
    }


	/*
	 * Getters
	 */
	public function getData($param)
	{
		return $this->data[$param];
	}


    /*
     * Render Functions
     */
    public function header()
    {
        require 'views/header.php';
    }

    public function render($file)
    {
	    require 'views/' . $file . '.php';
    }

    public function footer()
    {
        require 'views/footer.php';
    }


    /*
     * Add Files & Data To The View
     */
    public function addJS($jsFile)
    {
        array_push($this->jsFiles, $jsFile);
    }

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
	}
}