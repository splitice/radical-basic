<?php
namespace Radical\Basic\Cryptography;

class Blowfish implements HashTypes\ITwoWayEncryption {
	const IV = '12345678';
	
	static function encode($cleartext, $key = null, $iv = self::IV){
		if(extension_loaded('mcrypt')){
			$cipher = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_CBC, '');
			
			// 128-bit blowfish encryption
			if (mcrypt_generic_init($cipher, $key, $iv) != -1)
			{
				// PHP pads with NULL bytes if $cleartext is not a multiple of the block size..
				$cipherText = mcrypt_generic($cipher, $cleartext);
				mcrypt_generic_deinit($cipher);
				
				return $cipherText;
			}
		}else{
			$b = new Blowfish\Native($key, Blowfish\Native::BLOWFISH_MODE_CBC, Blowfish\Native::BLOWFISH_PADDING_RFC,$iv);
			
			return $b->encrypt($cleartext, $key, Blowfish\Native::BLOWFISH_MODE_CBC, Blowfish\Native::BLOWFISH_PADDING_RFC,$iv);
		}
	}
	public static function decode($text, $key = null, $iv = self::IV){
		if(extension_loaded('mcrypt')){
			$cipher = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_CBC, '');
			
			// 128-bit blowfish decryption
			if (mcrypt_generic_init($cipher, $key, $iv) != -1)
			{
				// PHP pads with NULL bytes if $text is not a multiple of the block size..
				$clearText = mdecrypt_generic($cipher, $text);
				mcrypt_generic_deinit($cipher);
				
				return $clearText;
			}
		}else{
			$b = new Blowfish\Native($key, Blowfish\Native::BLOWFISH_MODE_CBC, Blowfish\Native::BLOWFISH_PADDING_RFC,$iv);
				
			return $b->decrypt($text, $key, Blowfish\Native::BLOWFISH_MODE_CBC, Blowfish\Native::BLOWFISH_PADDING_RFC,$iv);
		}
	}
}