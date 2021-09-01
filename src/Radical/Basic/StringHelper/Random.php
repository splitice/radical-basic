<?php
namespace Radical\Basic\StringHelper;

class Random {
	/**
	 * A closure which, given a number of bytes, returns that amount of
	 * random bytes.
	 *
	 * @var Closure
	 */
	protected static $_source;
	
	/**
	 * Initializes `String::$_source` using the best available random number generator.
	 *
	 * When available, `/dev/urandom` and COM gets used on *nix and
	 * [Windows systems](http://msdn.microsoft.com/en-us/library/aa388182%28VS.85%29.aspx?ppud=4),
	 * respectively.
	 *
	 * If all else fails, a Mersenne Twister gets used. (Strictly
	 * speaking, this fallback is inadequate, but good enough.)
	 *
	 * @see lithium\util\String::$_source
	 * @return closure Returns a closure containing a random number generator.
	 * @author Lithium
	 */
	protected static function _source() {
		switch (true) {
			case isset(static::$_source):
				return static::$_source;
			case is_readable('/dev/urandom') && $fp = fopen('/dev/urandom', 'rb'):
				return static::$_source = function($bytes) use (&$fp) {
					return fread($fp, $bytes);
				};
			default:
				return static::$_source = function($bytes) {
					$rand = '';
	
					for ($i = 0; $i < $bytes; $i++) {
						$rand .= chr(mt_rand(0, 255));
					}
					return $rand;
				};
		}
	}
	
	/**
	 * Generates random bytes for use in UUIDs and password salts, using
	 * (when available) a cryptographically strong random number generator.
	 *
	 * {{{
	 * $bits = Basic\String\Random::GenerateBytes(8); // 64 bits
	 * $hex = bin2hex($bits); // [0-9a-f]+
	 * }}}
	 *
	 *
	 * @param integer $bytes The number of random bytes to generate.
	 * @return string Returns a string of random bytes.
	 */
	static function generateBytes($bytes){
		$source = static::$_source ?: static::_source();
		return $source($bytes);
	}
	
	/**
	 * Generates random bytes for use in UUIDs and password salts, using
	 * (when available) a cryptographically strong random number generator.
	 *
	 * {{{
	 * $str = Basic\String\Random::GenerateBase64(8); // 64 bits
	 * echo $str; // base64+
	 * }}}
	 * 
	 * Base64-encodes the resulting random string per the following:
	 *
	 *  _The alphabet used by `base64_encode()` is different than the one we should be using. When
	 * considering the meaty part of the resulting string, however, a bijection allows to go the
	 * from one to another. Given that we're working on random bytes, we can use safely use
	 * `base64_encode()` without losing any entropy._
	 * 
	 * @param integer $bytes The number of random bytes to generate.
	 * @return string Returns a base64 encoded string of random bytes.
	 */
	static function generateBase64($bytes){
		$result = static::GenerateBytes($bytes);
		return strtr(rtrim(base64_encode($result), '='), '+', '.');
	}
	
	/**
	 * Generates random bytes for use in UUIDs and password salts, using
	 * (when available) a cryptographically strong random number generator.
	 *
	 * {{{
	 * $str = Basic\String\Random::GenerateHex(8); // 64 bits
	 * echo $str; // hex+
	 * }}}
	 *
	 * Base64-encodes the resulting random string per the following:
	 *
	 * @param integer $bytes The number of random bytes to generate.
	 * @return string Returns a hex encoded string of random bytes.
	 */
	static function generateHex($bytes){
		$result = static::GenerateBytes($bytes);
		return bin2hex($result);
	}
}