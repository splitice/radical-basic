<?php
namespace Radical\Basic\Cryptography\HashTypes;

interface ISingleDecode extends IDecode {
	static function decode($encText);
}