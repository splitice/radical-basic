<?php
namespace Radical\Basic\String;

class Reader {
	private $string;
	private $pos = 0;
	private $movePosition = true;
	
	function __construct($str) {
		$this->string = $str;
	}
	
	function movePointer($mode) {
		$this->movePosition = $mode;
	}
	
	function string() {
		return substr ( $this->string, $this->pos );
	}
	
	function length() {
		return (strlen ( $this->string ) - $this->pos) - 1;
	}
	
	function readUntil($chars) {
		if (is_string ( $chars )) {
			if (strlen ( $chars ) == 1) {
				$chars = array ($chars );
			}
		}
		
		$str = $this->String ();
		
		if (is_array ( $chars )) {
			$ret = '';
			for($i = 0, $f = strlen ( $str ); $i < $f; ++ $i) {
				$char = ( string ) $str {$i};
				$ret .= $char;
				if (in_array ( $char, $chars )) {
					if ($this->movePosition) {
						$this->pos += $i+1;
					}
					return $ret;
				}
			}
		}else{
			$s = '';
			$len = strlen($chars);
			for($i = 0, $f = strlen ( $str ); $i < $f; ++ $i) {
				$char = substr($str,$i,$len);
				if ($char == $chars) {
					if ($this->movePosition) {
						$this->pos += $i + $len;
					}
					return $s;
				}
				$s .= $char{0};
			}
		}
		return '';
	}
}