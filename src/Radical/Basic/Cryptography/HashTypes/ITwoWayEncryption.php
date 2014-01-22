<?php
namespace Radical\Basic\Cryptography\HashTypes;

interface ITwoWayEncryption extends IEncode {
	static function decode($text, $key = null);
	static function encode($text, $key = null);
	//PHP Strangeness?
}