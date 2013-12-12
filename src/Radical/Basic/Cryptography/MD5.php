<?php
namespace Radical\Basic\Cryptography;

use Radical\Basic\Cryptography\Internal\HashBase;

class MD5 extends HashBase implements HashTypes\IOneWayHash {
	static function hash($text){
		return md5($text);
	}
}