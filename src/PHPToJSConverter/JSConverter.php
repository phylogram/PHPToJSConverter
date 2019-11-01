<?php


namespace PHPToJSConverter;


class JSConverter {

	static function to_javascript($php) {

		switch (gettype($php)) {
			case 'object':
				return static::object_to_javascript($php);
				break;
			case 'string':
				return static::string_to_javascript($php);
				break;
			case 'integer':
			case 'double':
				return static::number_to_javascript($php);
				break;
			case 'boolean':
				return static::boolean_to_javascript($php);
				break;
			case 'NULL':
				return static::null__to_javascript($php);
				break;
			case 'array':
				return static::array_to_javascript($php);
				break;
			default:
				return static::fallback($php);


		}

	}

	static function object_to_javascript($object) {
	    switch (get_class($object)) {
			case 'PHPToJSConverter\Items\LiteralJSCode':
				return static::LiteralJSCode_to_javascript($object);
				break;
			default:
				return static::fallback($object);
		}
	}

	static function LiteralJSCode_to_javascript($LiteralJSCode) {
		return " $LiteralJSCode->code_string "; // add white space before and after to not mix up syntax (if or not necessary)
	}



	static function string_to_javascript($string) {
		return " '$string' "; // add white space before and after to not mix up syntax (if or not necessary)
	}

	static function number_to_javascript($number) {
		return " $number "; // add white space before and after to not mix up syntax (if or not necessary)
	}

	static function boolean_to_javascript($boolean) {

		if ($boolean === TRUE) {
			$js_boolean = 'true';
		} elseif ($boolean === FALSE) {
			$js_boolean = 'false';
		} else {
			// still do not like phps build in type conversion. But as a fallback
			$js_boolean = $boolean ? 'false' : 'true';
		}

		return " $js_boolean "; // add white space before and after to not mix up syntax (if or not necessary)
	}

	static function null__to_javascript($null) {
		return " null "; // add white space before and after to not mix up syntax (if or not necessary)
	}

	static function array_to_javascript($array) {

		if (static::array_keys_can_be_js_object_properties($array)) {
			return static::php_array_to_javascript_object($array);
		} else {
			return static::php_array_to_javascript_array($array);
		}

	}

	static function array_keys_can_be_js_object_properties($array) {

		$array_keys_can_be_js_object_properties = TRUE;

		foreach (array_keys($array) as $key) {
			if (is_numeric($key)) {
				$array_keys_can_be_js_object_properties = FALSE;
				break;
			}
		}

		return $array_keys_can_be_js_object_properties;

	}

	static function php_array_to_javascript_array($array) {
		$inner_array = implode(', ', array_map([get_called_class(), 'to_javascript'], $array));
		return " [$inner_array] ";
	}

	static function php_array_to_javascript_object($array) {

		$inner_array = array_map(function($key, $value) {
			$value = static::to_javascript($value);
			return " {$key}: {$value}";
		}, array_keys($array), array_values($array));

		$inner_js_array = implode(', ', $inner_array);

		return " { {$inner_js_array} } ";
	}


	static function fallback($php) {
		return json_encode($php);
	}

}