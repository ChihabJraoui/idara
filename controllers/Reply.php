<?php

/*
 * Reply Controller Class.
 */

class ReplyController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function getReplies()
    {
        if(filter_input(INPUT_POST, "ajax"))
        {
            $tID = filter_input(INPUT_POST, "topicID");
            $this->view->render('topic/replies');
        }
        else
        {
            header('Location: ../index');
        }
    }
    
    function add()
    {
        if(filter_input(INPUT_POST, "ajax"))
        {
            $replyDAO = new DAO\Reply();

	        $memberID = filter_input(INPUT_POST, 'memberID');
	        $topicID = filter_input(INPUT_POST, 'topicID');

	        $data = array(
                "TopicID" => $topicID,
                "Status" => 1,
                "Content" => filter_input(INPUT_POST, "content"),
                "Author" => $memberID,
                "DateC" => date("Y-m-d H:i:s") );

	        $r = new Objects\Reply($data);
            $replyDAO->Add($r);
            echo 1;
        }
        else
        {
            Func::Redirect('../index', TRUE);
        }
    }
}