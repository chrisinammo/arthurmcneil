<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FastJSON {

	// public methods

	/**
	 * public static method
	 *
	 *	FastJSON::convert(params:* [, result:Instance]):*
	 *
	 * @param	*		String or Object
	 * @param	Instance	optional new generic class instance if first
	 *				parameter is an object.
	 * @return	*		time() value or new Instance with object parameters.
	 *
	 * @note	please read Special FastJSON::convert method Informations
	 */
	function convert($params, $result = null){
		switch(gettype($params)){
			case	'array':
				$tmp = array();
				foreach($params as $key => $value) {
					if(($value = FastJSON::encode($value)) !== '')
					array_push($tmp, FastJSON::encode(strval($key)).':'.$value);
				};
				$result = '{'.implode(',', $tmp).'}';
				break;
			case	'boolean':
				$result = $params ? 'true' : 'false';
				break;
			case	'double':
			case	'float':
			case	'integer':
				$result = $result !== null ? strftime('%Y-%m-%dT%H:%M:%S', $params) : strval($params);
				break;
			case	'NULL':
				$result = 'null';
				break;
			case	'string':
				$i = create_function('&$e, $p, $l', 'return intval(substr($e, $p, $l));');
				if(preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $params))
				$result = mktime($i($params, 11, 2), $i($params, 14, 2), $i($params, 17, 2), $i($params, 5, 2), $i($params, 9, 2), $i($params, 0, 4));
				break;
			case	'object':
				$tmp = array();
				if(is_object($result)) {
					foreach($params as $key => $value)
					$result->$key = $value;
				} else {
					$result = get_object_vars($params);
					foreach($result as $key => $value) {
						if(($value = FastJSON::encode($value)) !== '')
						array_push($tmp, FastJSON::encode($key).':'.$value);
					};
					$result = '{'.implode(',', $tmp).'}';
				}
				break;
		}
		return $result;
	}

	/**
	 * public method
	 *
	 *	FastJSON::decode(params:String[, useStdClass:Boolean]):*
	 *
	 * @param	String	valid JSON encoded string
	 * @param	Bolean	uses stdClass instead of associative array if params contains objects (default false)
	 * @return	*	converted variable or null
	 *				is params is not a JSON compatible string.
	 * @note	This method works in an optimist way. If JSON string is not valid
	 * 		the code execution will die using exit.
	 *		This is probably not so good but JSON is often used combined with
	 *		XMLHttpRequest then I suppose that's better more protection than
	 *		just some WARNING.
	 *		With every kind of valid JSON string the old error_reporting level
	 *		and the old error_handler will be restored.
	 *
	 * @example
	 *		FastJSON::decode('{"param":"value"}'); // associative array
	 *		FastJSON::decode('{"param":"value"}', true); // stdClass
	 *		FastJSON::decode('["one",two,true,false,null,{},[1,2]]'); // array
	 */
	function decode($encode, $stdClass = false){
		$pos = 0;
		$slen = is_string($encode) ? strlen($encode) : null;
		if($slen !== null) {
			$error = error_reporting(0);
			set_error_handler(array('FastJSON', '__exit'));
			$result = FastJSON::__decode($encode, $pos, $slen, $stdClass);
			error_reporting($error);
			restore_error_handler();
		}
		else
		$result = null;
		return $result;
	}

	/**
	 * public method
	 *
	 *	FastJSON::encode(params:*):String
	 *
	 * @param	*		Array, Boolean, Float, Int, Object, String or NULL variable.
	 * @return	String		JSON genric object rappresentation
	 *				or empty string if param is not compatible.
	 *
	 * @example
	 *		FastJSON::encode(array(1,"two")); // '[1,"two"]'
	 *
	 *		$obj = new MyClass();
	 *		obj->param = "value";
	 *		obj->param2 = "value2";
	 *		FastJSON::encode(obj); // '{"param":"value","param2":"value2"}'
	 */
	function encode($decode){
		$result = '';
		switch(gettype($decode)){
			case	'array':
				
				if(!count($decode) || array_keys($decode) === range(0, count($decode) - 1)) {
					$keys = array();
					foreach($decode as $value) {
						if(($value = FastJSON::encode($value)) !== '')
						array_push($keys, $value);
					}
					$result = '['.implode(',', $keys).']';
				}
				else
				$result = FastJSON::convert($decode);
				break;
			case	'string':
				$replacement = FastJSON::__getStaticReplacement();
				$result = '"'.str_replace($replacement['find'], $replacement['replace'], $decode).'"';
				break;
			default:
				if(!is_callable($decode))
				$result = FastJSON::convert($decode);
				break;
		}
		return $result;
	}

	// private methods, uncommented, sorry
	function __getStaticReplacement(){
		static $replacement = array('find'=>array(), 'replace'=>array());
		if($replacement['find'] == array()) {
			foreach(array_merge(range(0, 7), array(11), range(14, 31)) as $v) {
				$replacement['find'][] = chr($v);
				$replacement['replace'][] = "\\u00".sprintf("%02x", $v);
			}
			$replacement['find'] = array_merge(array(chr(0x5c), chr(0x2F), chr(0x22), chr(0x0d), chr(0x0c), chr(0x0a), chr(0x09), chr(0x08)), $replacement['find']);
			$replacement['replace'] = array_merge(array('\\\\', '\\/', '\\"', '\r', '\f', '\n', '\t', '\b'), $replacement['replace']);
		}	
		return $replacement;
	}
	function __decode(&$encode, &$pos, &$slen, &$stdClass){
		switch($encode{$pos}) {
			case 't':
				$result = true;
				$pos += 4;
				break;
			case 'f':
				$result = false;
				$pos += 5;
				break;
			case 'n':
				$result = null;
				$pos += 4;
				break;
			case '[':
				$result = array();
				++$pos;
				while($encode{$pos} !== ']') {
					array_push($result, FastJSON::__decode($encode, $pos, $slen, $stdClass));
					if($encode{$pos} === ',')
						++$pos;
				}
				++$pos;
				break;
			case '{':
				$result = $stdClass ? new stdClass : array();
				++$pos;
				while($encode{$pos} !== '}') {
					$tmp = FastJSON::__decodeString($encode, $pos);
					++$pos;
					if($stdClass)
						$result->$tmp = FastJSON::__decode($encode, $pos, $slen, $stdClass);
					else
						$result[$tmp] = FastJSON::__decode($encode, $pos, $slen, $stdClass);
					if($encode{$pos} === ',')
						++$pos;
				}
				++$pos;
				break;
			case '"':
				switch($encode{++$pos}) {
					case '"':
						$result = "";
						break;
					default:
						$result = FastJSON::__decodeString($encode, $pos);
						break;
				}
				++$pos;
				break;
			default:
				$tmp = '';
				preg_replace('/^(\-)?([0-9]+)(\.[0-9]+)?([eE]\+[0-9]+)?/e', '$tmp = "\\1\\2\\3\\4"', substr($encode, $pos));
				if($tmp !== '') {
					$pos += strlen($tmp);
					$nint = intval($tmp);
					$nfloat = floatval($tmp);
					$result = $nfloat == $nint ? $nint : $nfloat;
				}
				break;
		}
		return $result;
	}
	function __decodeString(&$encode, &$pos) {
		$replacement = FastJSON::__getStaticReplacement();
		$endString = FastJSON::__endString($encode, $pos, $pos);
		$result = str_replace($replacement['replace'], $replacement['find'], substr($encode, $pos, $endString));
		$pos += $endString;
		return $result;
	}
	function __endString(&$encode, $position, &$pos) {
		do {
			$position = strpos($encode, '"', $position + 1);
		}while($position !== false && FastJSON::__slashedChar($encode, $position - 1));
		if($position === false)
			trigger_error('', E_USER_WARNING);
		return $position - $pos;
	}
	function __exit($str, $a, $b) {
		exit($a.'FATAL: FastJSON decode method failure [malicious or incorrect JSON string]');
	}
	function __slashedChar(&$encode, $position) {
		$pos = 0;
		while($encode{$position--} === '\\')
			$pos++;
		return $pos % 2;
	}
}
?>