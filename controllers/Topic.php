<?php

/*
 * Topic Controller Class
 */

class TopicController extends Controller
{
	private $topicDAO;

    function __construct()
    {
        parent::__construct();

	    $this->topicDAO = new DAO\Topic();
    }

    public function index()
    {
        if(filter_input(INPUT_GET, 't'))
        {
            $this->view->addJS('ajax_topic.js');
	        $this->view->addCSS('topic.css');
	        $this->view->addCSS('reply.css');

            $this->view->header();
            $this->view->Render('topic/index');
            $this->view->footer();
        }
        else
        {
            Func::Redirect('index', true);
        }
    }
    
    public function addTopic()
    {
        if(filter_input(INPUT_POST, 'ajax'))
        {
            $forumID = filter_input(INPUT_POST, "forumID");
            $subject = filter_input(INPUT_POST, "subject");
            $content = filter_input(INPUT_POST, "content");
            $author = filter_input(INPUT_POST, "memberID");

            /* Add New Topic */
            $data = array(
	            "ForumID" => $forumID,
                "Subject" => $subject,
                "Status" => 1,
                "Content" => $content,
                "Author" => $author );

            $t = new Objects\Topic($data);
            $this->topicDAO->Add($t);

            echo 1;
        }
        else
        {
            header('Location: ../');
        }
    }
    
    public function removeTopic()
    {
        if(filter_input(INPUT_POST, 'ajax') !== NULL)
        {
            $tID = filter_input(INPUT_POST, "topicID");
            $mID = filter_input(INPUT_POST, "memberID");

            $this->topicDAO->Remove($tID, $mID);

            echo 1;
        }
        else
        {
            header('Location: ../../index');
        }
    }
    
    public function deleteTopic()
    {
        $id = filter_input(INPUT_POST, "id");

        $this->topicDAO->delete($id);
        
        echo 1;
    }
    
    public function stickTopic()
    {
        $topicID = filter_input(INPUT_POST, "topicID");
        $memberID = filter_input(INPUT_POST, "memberID");

        $this->topicDAO->Stick($topicID, $memberID);
        
        echo 1;
    }
    
    public function addFavorite()
    {
        if(filter_input(INPUT_POST, 'ajax') !== NULL)
        {
            $mID = filter_input(INPUT_POST, "memberID");
            $tID = filter_input(INPUT_POST, "topicID");
            
            if($this->topicDAO->isFavoriteExists($mID, $tID))
            {
                echo 'تم إضافة الموضوع من قبل';
            }
            else
            {
                $this->topicDAO->addFavorite($mID, $tID);
                echo 1;
            }
        }
        else
        {
            header('Location: ../');
        }
    }

	public function addLike()
	{
		if(filter_input(INPUT_POST, 'ajax'))
		{
			$memberID = filter_input(INPUT_POST, 'memberID');
			$topicID = filter_input(INPUT_POST, 'topicID');
			$like = filter_input(INPUT_POST, 'likes');

			// (addLike) function prints 0 or 1 or 2.
			$this->topicDAO->addLike($memberID, $topicID, $like);
		}
		else
		{
			Func::Redirect('../', true);
		}
	}
}