<?php


namespace PHPToJSConverter\Items;

/**
 * Class LiteralJSCode
 * @package js_converter
 *
 * The sole purpose of this class, is to let the JSConverter class know, this is code, not string.
 */
class LiteralJSCode {
	/**
	 * @var string The Code, that sould not be handled as sting, but printed out literally.
	 */

	public $code_string;

	public function __construct($code_string) {
		$this->code_string = $code_string;
	}

	public function __toString() {
		return $this->code_string;
	}

}