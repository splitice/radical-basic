<?php
namespace Radical\Basic\Structs;

interface ILoginDetails {
	/**
	 * @return array of details
	 */
	function getDetails($detail);
	
	/**
	 * Do we have details?
	 *
	 * @return bool true if we have details
	 */
	function hasDetails();
}