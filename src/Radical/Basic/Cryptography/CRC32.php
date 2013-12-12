<?php
namespace Radical\Basic\Cryptography;

use Radical\Basic\Cryptography\Internal\HashBase;

class CRC32 extends HashBase implements HashTypes\IOneWayHash {
	static function hash($text){
		$r = crc32 ( $text );
		if (PHP_INT_SIZE == 8 && ($r > 0x7FFFFFFF)) {
			$r -= 0x100000000;
		}
		return $r;
	}
}