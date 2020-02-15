<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 18/01/2016
 * Time: 11:59
 */

namespace Ajax;

use \Controller;

class Statistics extends Controller
{
    private $statDAO;

    public function __construct()
    {
        parent::__construct();

        $this->statDAO = new \DAO\Statistics($this->db);
    }

    public function getWebsiteHits()
    {
        $data = $this->statDAO->websiteHits();

        // print JSON data
        echo json_encode($data);
    }

    public function getUniqueVisitors()
    {
        $data = $this->statDAO->uniqueVisitors();

        echo json_encode($data);
    }
}