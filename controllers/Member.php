<?php

/*
 * Member Controller Class.
 */

class Member extends \Controller
{
    public function __construct()
    {
        parent::__construct();

	    $this->view->addJS('js/member.js');
    }

    public function index()
    {
        $this->view->header();
        $this->view->render('members/members');
        $this->view->footer();
    }
    
    public function online()
    {
        require 'views/members/online.view.php';
    }
    
    public function search()
    {
        $this->view->header();
        $this->view->render('members/search');
        $this->view->footer();
    }
    
    public function statistics()
    {
        // set page title
        $pageTitle = 'احصائيات الأعضاء';

        $this->view->addData('pageTitle', $pageTitle);

        $this->view->addJS('js/plugins/Chart.min.js');
        $this->view->addJS('js/member_stats.js');

        $this->view->header();
        $this->view->render('members/statistics');
        $this->view->footer();
    }
}
