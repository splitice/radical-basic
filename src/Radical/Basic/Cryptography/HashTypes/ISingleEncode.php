<?php
namespace Radical\Basic\Cryptography\HashTypes;

interface ISingleEncode extends IEncode {
	static function encode($text);
}