<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Pp_hash {

	function __construct() {
		$this->CI = &get_instance();
	}
	/**
	 * @param $data
	 * @param $algo
	 * @param $salt
	 */
	public static function create($data, $algo = 'md5', $salt = '@#parmesh_shiroya#@') {
		$context = hash_init($algo, HASH_HMAC, $salt);
		hash_update($context, $data);
		return hash('sha256', hash_final($context) . '#@color9infotech@#');

	}

	/**
	 * @param $string
	 * @return mixed
	 */
	public function encrypt_data($string) {
		$enc_key = 'pj6007_enc_key';
		$iv      = mcrypt_create_iv(
			mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
			MCRYPT_DEV_URANDOM
		);
		$encrypted = base64_encode(
			$iv .
			mcrypt_encrypt(
				MCRYPT_RIJNDAEL_128,
				hash('sha256', $enc_key, true),
				$string,
				MCRYPT_MODE_CBC,
				$iv
			)
		);
		return $encrypted;
	}
	/**
	 * @param $enc_string
	 * @return mixed
	 */
	public function decrypt_data($enc_string) {
		$enc_key = 'pj6007_enc_key';

		$data = base64_decode($enc_string);
		$iv   = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

		$decrypted = rtrim(
			mcrypt_decrypt(
				MCRYPT_RIJNDAEL_128,
				hash('sha256', $enc_key, true),
				substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
				MCRYPT_MODE_CBC,
				$iv
			),
			"\0"
		);
		return $decrypted;
	}
}
