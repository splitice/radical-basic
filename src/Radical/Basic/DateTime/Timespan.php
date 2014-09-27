<?php
namespace Radical\Basic\DateTime;

class Timespan {
	protected $seconds;
	
	function __construct($seconds){
		$this->seconds = $seconds;
	}

    function toHuman(){
        $secs = $this->seconds;
        $units = array(
            "week"   => 7*24*3600,
            "day"    =>   24*3600,
            "hour"   =>      3600,
            "minute" =>        60,
            "second" =>         1,
        );

        // specifically handle zero
        if ( $secs == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
            if ( $quot = intval($secs / $divisor) ) {
                $s .= "$quot $name";
                $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                $secs -= $quot * $divisor;
            }
        }

        return substr($s, 0, -2);
    }

	static function fromBetween($timestamp1,$timestamp2){
		return new static(abs($timestamp1 - $timestamp2));
	}
	static function fromHuman($d){
		if(($a=substr($d,-4))=='hour' && is_numeric($b = trim(substr($d,0,-4)))){
			return ($b*60*60);
		}elseif(($a=substr($d,-5))=='hours' && is_numeric($b = trim(substr($d,0,-5)))){
			return ($b*60*60);
		}elseif(($a=substr($d,-3))=='min' && is_numeric($b = trim(substr($d,0,-3)))){
			return ($b*60);
		}elseif(($a=substr($d,-4))=='mins' && is_numeric($b = trim(substr($d,0,-4)))){
			return ($b*60);
		}
		return new static($d);
	}
}