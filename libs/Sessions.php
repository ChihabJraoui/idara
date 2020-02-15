<?php

/*
 * Session Handler Class.
 */

class Sessions
{
	public static function init_session()
    {
	    session_start();
    }

    public static function isExist($key)
    {
        if(isset($_SESSION[$key]))
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
        return $_SESSION[$key];
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function destroy()
    {
        session_destroy();
    }
}