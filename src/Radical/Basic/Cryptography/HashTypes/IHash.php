<?php
namespace Radical\Basic\Cryptography\HashTypes;

interface IHash {
	static function hash($text);
	static function compare($text,$hash);
}
