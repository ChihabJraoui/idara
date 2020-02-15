<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 18/01/2016
 * Time: 11:59
 */

namespace App\Ajax;



use App\DAO\Member as MemberDAO;
use Controller;



class Member extends Controller
{

    private $memberDAO;

    public function __construct()
    {
        parent::__construct();

        $this->memberDAO = new MemberDAO($this->db);
    }



    public function search()
    {
	    $word = filter_input(INPUT_POST, 'word');

	    $members = $this->memberDAO->search($word);

	    $this->view->addData('members', $members);

	    $this->view->render('members/search_result');
    }




    /*
     *    STATISTICS
     */

    public function getMembersLevels()
    {
        $data = $this->memberDAO->getMembersLevels();

        header('Content-Type: application/json');
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    public function getLockedMembers()
    {
        $data = $this->memberDAO->getLockedMembers();

        header('Content-Type: application/json');
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }
}