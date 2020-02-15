<?php

class StatisticsController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function hitsThisMonth()
    {
            $statsDAO = new StatisticsDAO();
            $data = $statsDAO->hitsThisMonth();
            echo $data;
    }
    
    public function visitorsThisMonth()
    {
            $statsDAO = new StatisticsDAO();
            $data = $statsDAO->visitorsThisMonth();
            echo $data;
    }
}