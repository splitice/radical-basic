<?php
namespace Radical\Basic\StringHelper;

class Number  {
	static function ordinal($number){
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if (($number %100) >= 11 && ($number%100) <= 13)
			$abbreviation = $number. 'th';
		else
			$abbreviation = $number. $ends[$number % 10];
		
		return $abbreviation;
	}
	static function natural($int, $plurals = false) {
		$readable = array ("", "thousand", "million", "billion" );
		$index = 0;
		while ( $int > 1000 ) {
			$int /= 1000;
			$index ++;
		}
		$s = '';
		$num = round ( $int, 0 );
		if ($num != 1 && $plurals) {
			$s = 's';
		}
		return ($num . " " . $readable [$index]);
	}
	static function is($number){
		if(is_int($number)){
			return true;
		}
		if(is_numeric($number) && (int)$number == $number){
			return true;
		}
		return false;
	}
}