<?php
	class Cipher {
	    private $securekey, $iv;
	    function __construct($textkey) {
		$this->securekey = hash('sha256',$textkey,TRUE);
		$this->iv = mcrypt_create_iv(32);
	    }
	    function encrypt($input) {
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->securekey, $input, MCRYPT_MODE_ECB, $this->iv));
	    }
	    function decrypt($input) {
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->securekey, base64_decode($input), MCRYPT_MODE_ECB, $this->iv));
	    }
	}
	/* usage

	$cipher = new Cipher( $_REQUEST["domain"] );

	$encryptedtext = $cipher->encrypt("hide me");
	echo "->encrypt = $encryptedtext<br />";

	$decryptedtext = $cipher->decrypt($encryptedtext);
	echo "->decrypt = $decryptedtext<br />";

	var_dump($cipher);
	*/
?>
