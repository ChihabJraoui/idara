<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 10/13/2015
 * Time: 1:49 PM
 */


/*
 * Custom Error Handler Function
 *
 */
function customError($errLevel, $errMessage, $errFile, $errLine)
{
	if($errLevel != 8)
	{
		die('
		<table dir="ltr" class="table-condensed table-bordered">
		<tr>
			<td>Error Level: </td><td>'.$errLevel.'</td>
		</tr>
		<tr>
			<td>Error Message: </td><td>'.$errMessage.'</td>
		</tr>
		<tr>
			<td>File: </td><td>'.$errFile.'</td>
		</tr>
		<tr>
			<td>Line: </td><td>'.$errLine.'</td>
		</tr>
		</table>');
	}
}


/*
 * Set Error Handler Function.
 *
 */
set_error_handler("customError");