<?php
namespace Radical\Basic\Cryptography\Internal;

abstract class HashBase {
	static function encode($text,$key = null){
		return static::Hash($text);
	}
	static function compare($password,$hash){
		return ($password == $hash);
	}
}