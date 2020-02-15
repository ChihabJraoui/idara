<?php

class Config
{
	/*
	 * Constants
	 */
	const ImagesFolder = "images/";

    const CookiesPath = 'idara/';


	/*
	 * Fields
	 */
	private static $links = [

		'profile'           => 'u/i/',
		'editProfile'       => 'u/edit/',

		'forum'             => 'f/i/',
		"forumInfo"         => "f/info/",

		'topic'             => 't/i/',
		'editTopic'         => 't/edit/',
		'newTopic'          => 't/new/',

		'messages'          => 'messages/i/',

		'favorite'          => 'favorite/i/'
	];


	/*
	 * Functions
	 */
	public static function getLink($key)
	{
		return self::$links[$key];
	}
}