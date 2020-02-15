<?php

/*
 * Profile Controller Class
 */

class ProfileController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Index Methode
     */
    function index()
    {
        $this->view->addJS('ajax_profile.js');
        $this->view->addCSS('profile.css');

        $this->view->header();
	    $this->view->render('profile/profile');
	    $this->view->footer();
    }
    
    public function mainInfo()
    {
        if(filter_input(INPUT_POST, 'ajax'))
        {
            require 'views/profile/main.php';
        }
    }
    
    public function medals()
    {
	
    }
    
    public function comments()
    {
	
    }
    
    public function statistics()
    {
	if(filter_input(INPUT_POST, 'ajax'))
	{
	    require 'views/profile/stats.php';
	}
    }
    
    /*
     * 
     */
    public function follow()
    {
	if(filter_input(INPUT_POST, 'ajax'))
	{
	    $profileDAO = new DAO\Profile();
	    
	    $user = User::getInfo();
	    $memberID = filter_input(INPUT_POST, 'followerID');
	    
	    if($profileDAO->isFollowerExists($memberID, $user->getMemberID()) === FALSE)
	    {
		$profileDAO->addFollower($memberID, $user->getMemberID());
		echo 1;
	    }
	}
	else
	{
	    Func::Redirect('../', TRUE);
	}
    }
    
    public function unfollow()
    {
	if(filter_input(INPUT_POST, 'ajax'))
	{
	    $user = User::getInfo();
	    $memberID = filter_input(INPUT_POST, 'followerID');
	    $profileDAO = new DAO\Profile();
	    $profileDAO->removeFollower($memberID, $user->getMemberID());
	    echo 1;
	}
	else
	{
	    Func::Redirect('../', TRUE);
	}
    }
}