<?php

/* 
 * Cookies Handler Class.
 */

class Cookies
{

    public static function isExist($key)
    {
        if(isset($_COOKIE[$key]))
        {
            return true;
        }
	    else
	    {
		    return false;
	    }
    }
    
    public static function get($key)
    {
	    return $_COOKIE[$key];
    }

    public static function set($key, $value)
    {
	    $month = new DateTime("+1 month");
        setcookie($key, $value, $month->getTimestamp(), Config::CookiesPath, '', null, true);
    }

	public static function destroy($key)
	{
		setcookie($key, '', time() - 60, Config::CookiesPath, '', null, true);
	}
}