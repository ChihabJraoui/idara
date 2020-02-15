<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 08/01/2016
 * Time: 20:10
 */

namespace Idara;

class App
{
	public function run()
	{
		$rooter = new Rooter();

		$file = $rooter->getControllerFile();
		$controller = $rooter->getController();
		$function = $rooter->getFunction();
		$params = $rooter->getParams();


		if(file_exists($file))
		{
			require $file;

			$controller = new $controller();

			if(method_exists($controller, $function))
			{
				if($params != null)
				{
					$controller->{$function}($params);
				}
				else
				{
					$controller->{$function}();
				}
			}
			else
			{
				require 'controllers/Error.php';
				$error = new Error();
				$error->error404();
			}
		}
		else
		{
			require "controllers/Error.php";
			$Error = new Error();
			$Error->error404();
		}
	}
}