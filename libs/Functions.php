<?php

/*
 * Functions Static Class.
 * all static functions.
 */

class Func
{
    /*
     * Public Functions
     */

    public static function getDateTime($date)
    {
	    if(!empty($date))
	    {
		    $oldDate = new DateTime($date);
		    $currentDate = new DateTime();

		    $interval = $oldDate->diff($currentDate);

		    //TODO: add TimeZone

		    if ($interval->y == 0)
		    {
			    if ($interval->m == 0)
			    {
				    if ($interval->d == 0)
				    {
					    if ($interval->h == 0)
					    {
						    if ($interval->i == 0 OR $interval->i == 1)
						    {
							    $datetime = "منذ دقيقة";
						    }
						    else
						    {
							    if($interval->i == 2)
							    {
								    $datetime = 'منذ دقيقتين';
							    }
							    elseif($interval->i >= 3 and $interval->i <= 10)
							    {
								    $datetime = "منذ " . $interval->i . " دقائق";
							    }
							    else
							    {
								    $datetime = "منذ " . $interval->i . " دقيقة";
							    }
						    }
					    }
					    else
					    {
						    if($interval->h == 1)
						    {
							    $datetime = 'منذ ساعة';
						    }
						    elseif($interval->h == 2)
						    {
							    $datetime = 'منذ ساعتين';
						    }
						    elseif($interval->h >= 3 and $interval->h <= 10)
						    {
							    $datetime = "منذ " . $interval->h . " ساعات";
						    }
						    else
						    {
							    $datetime = "منذ " . $interval->h . " ساعة";
						    }
					    }
				    }
				    else
				    {
					    if($interval->d == 1)
					    {
						    $datetime = 'منذ الأمس';
					    }
					    elseif($interval->d == 2)
					    {
						    $datetime = 'منذ يومين';
					    }
					    elseif($interval->d >= 3 and $interval->d <= 10)
					    {
						    $datetime = "منذ " . $interval->d . " أيام";
					    }
					    else
					    {
						    $datetime = "منذ " . $interval->d . " يوم";
					    }
				    }
			    }
			    else
			    {
				    if($interval->m == 1)
				    {
					    $datetime = 'منذ شهر';
				    }
				    elseif($interval->m == 2)
				    {
					    $datetime = 'منذ شهرين';
				    }
				    elseif($interval->m >= 3 and $interval->m <= 10)
				    {
					    $datetime = "منذ " . $interval->m . " أشهر";
				    }
				    else
				    {
					    $datetime = "منذ " . $interval->m . " شهر";
				    }
			    }
		    }
		    else
		    {
			    $datetime = $interval->format('Y-m-d H:i');
		    }

		    return $datetime;
	    }
	    else
	    {
		    return null;
	    }
    }
    
    public static function redirect($link, $header = false)
    {
        if($header !== FALSE)
        {
            header('Location: ' . $link);
        }
        else
        {
            echo'
            <script>
                window.location = "'.$link.'";
            </script>';
        }
    }
    
    public static function error($txt)
    {
        echo'
        <div class="container">
	    <div class="wrapper" style="width: 400px; height: auto; padding: 20px;
	    box-shadow: 0 1px 6px #888; border: none;">
		<div style="text-align: center;">
			<img src="images/error-icon.png" height="64" />
		</div>
		<div style="text-align: center; padding: 10px;">
			<span style="color: Crimson; font: normal normal 22px kufi;">خطأ</span>
		</div>
		<div style="text-align: center; padding: 20px;">
			<span style="font: bold normal 13px tahoma;">'.$txt.'</span>
		</div>
	    </div>
        </div>';
    }
    
    public static function Success($txt)
    {
        echo'
        <div class="container">
            <div class="wrapper" style="width: 400px; height: auto;">
                <div style="text-align: center;">
                    <img src="images/success-icon.png" height="64" />
                </div>
                <div style="text-align: center; padding: 20px;">
                    <span style="font: bold normal 13px tahoma;">'.$txt.'</span>
                </div>
            </div>
        </div>';
    }
    
    public static function icon($src, $title = "", $width = 0, $height = 0)
    {
        $w = ''; $h = '';
        if($width != 0)
        {
            $w = ' width="'.$width.'"';
        }
        if($height != 0)
        {
            $h = ' height="'.$height.'"';
        }

        return '<img src="'.$src.'" title="' .$title . '"' . $w . $h . '>';
    }
    
    public static function getPageName($title = '')
    {
	    if(!empty($title))
	    {
		    $pageName = $title;
	    }
	    else
	    {
		    $url = self::parseUrl();

		    switch($url['controller'])
		    {
			    case '':                $pageName = 'الرئيسية'; break;
			    case 'index':           $pageName = 'الرئيسية'; break;
			    case 'member':          $pageName = 'الأعضاء'; break;
			    case 'favorite':        $pageName = 'المفضلة'; break;

			    default:                $pageName = '';
		    }
	    }

	    return $pageName . ' - منتديات الآفاق';
    }

	public static function editorReplace($data)
	{
		$data = str_replace("'", '"', $data);
		return $data;
	}

	public static function secure($data)
	{
		$data = htmlspecialchars($data, ENT_QUOTES, "UTF-8");
		return $data;
	}

	public static function parseUrl()
	{
		$url = filter_input(INPUT_GET, "url");
		$trimUrl = rtrim($url, '/');
		$url = explode('/', $trimUrl);

		return array(
			"controller" => $url[0],
			"function" => $url[1],
			"params" => $url[2]
		);
	}

	public static function checkRadio($val1, $val2)
	{
		if($val1 == $val2)
		{
			return "checked";
		}
		else
		{
			return "";
		}
	}

	public static function checkSelect($val1, $val2)
	{
		if($val1 == $val2)
		{
			return "selected";
		}
		else
		{
			return "";
		}
	}




    /*
     * Statistics
     */

    public static function totalRatio($total, $newValue)
    {
        if(is_numeric($total) AND is_numeric($newValue))
        {
            $total = intval($total);
            $newValue = intval($newValue);

            if($total == 0)
            {
                if($newValue == 0)
                {
                    $result = 0;
                }
                else
                {
                    $result = ($newValue * 100) / 1;
                }
            }
            else
            {
                $result = ($newValue * 100) / $total;
            }

            return $result;
        }
        else
        {
            return false;
        }
    }

    public static function newRatio($oldValue, $newValue)
    {
        if(is_numeric($oldValue) AND is_numeric($newValue))
        {
            $oldValue = intval($oldValue);
            $newValue = intval($newValue);

            if($oldValue == 0)
            {
                if($newValue == 0)
                {
                    $result = 0;
                }
                else
                {
                    $result = ($newValue * 100) / 1;
                }
            }
            elseif($oldValue > $newValue)
            {
                $result = 100 - (($newValue * 100) / $oldValue);
            }
            elseif($oldValue < $newValue)
            {
                $result = (($newValue * 100) / $oldValue) - 100;
            }
            else
            {
                $result = 0;
            }

            return $result;
        }
        else
        {
            return false;
        }
    }
}