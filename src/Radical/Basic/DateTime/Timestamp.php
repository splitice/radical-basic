<?php
namespace Radical\Basic\DateTime;

class Timestamp {
	protected $timestamp;
	
	function __construct($timestamp){
		$this->timestamp = $timestamp;
	}
	function add($ammount){
		$ts = strtotime('+'.$ammount,$this->timestamp);
		return new static($ts);
	}
	function sub($ammount){
		$ts = strtotime('-'.$ammount,$this->timestamp);
		return new static($ts);
	}
	function toFormat($format){
		return gmdate($format,$this->timestamp);
	}
    function getTimestamp(){
        return $this->timestamp;
    }
	function timespan(Timestamp $other){
        $other_ts = $other->getTimestamp();
        return new Timespan($this->getTimestamp()-$other_ts);
    }
    function toAgo($ago=true)
	{
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");
	
		$now = time();
	
		$difference     = $now - $this->timestamp;
		$tense         = "ago";
	
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
	
		$difference = round($difference);
	
		if($difference != 1) {
			$periods[$j].= "s";
		}
	
		if($ago){
			$ago = ' ago';
		}
	
		return $difference.' '.$periods[$j].$ago;
	}
	function __toString(){
		return (string)$this->timestamp;
	}
}
