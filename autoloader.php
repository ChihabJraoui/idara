<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 18/02/2016
 * Time: 19:58
 */


/*
 * Set default timezone = GMT
 */
date_default_timezone_set("UTC");


/*
 * Start Session
 */
session_start();

/*
 * Include Libraries
 */
require_once "libs/error_handler.php";
require_once "database/DBConnection.php";
require_once "dao/WebConfig.php";

require_once 'libs/Config.php';
require_once 'libs/Cookies.php';
require_once 'libs/Sessions.php';
require_once "libs/Functions.php";
require_once "libs/IP.php";

require_once 'libs/Controller.php';
require_once 'libs/View.php';
require_once 'libs/User.php';
require_once 'libs/Rooter.php';
require_once 'libs/App.php';

/*
 * include Object Classes
 */
require_once 'object/Member.php';
require_once 'object/Photo.php';
require_once 'object/Category.php';
require_once 'object/Forum.php';
require_once 'object/Topic.php';
require_once 'object/Reply.php';
require_once 'object/Message.php';
require_once "object/Online.php";
require_once "object/Pagination.php";
require_once "object/Notification.php";


/*
 * Require DAO Classes
 */
require_once 'dao/Category.php';
require_once 'dao/Forum.php';
require_once 'dao/Member.php';
require_once 'dao/Topic.php';
require_once 'dao/Reply.php';
require_once 'dao/Favorite.php';
require_once 'dao/Online.php';
require_once 'dao/Profile.php';
require_once 'dao/Notification.php';
require_once 'dao/Functions.php';
require_once 'dao/Statistics.php';


/*
 * Handle Search Query
 */
//if(filter_input(INPUT_POST, "searchQuery") !== NULL)
//{
//    header("Location: index?get=search&query=" . filter_input(INPUT_POST, "searchQuery"));
//}