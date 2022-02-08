<?php

namespace Vinhais\OsascoNfePhpSdk;

use SimpleXMLElement;

class XML
{
	/**
	 * Transforma uma array em XML
	 *
	 * @param array $array
	 * @param string $rootElement
	 * @param string $xml
	 * @return string
	 */
	public static function ArrayToXml(
		$array, 
		$rootElement = null, 
		$xml = null
	) {
	    $_xml = $xml;

	    if ($_xml === null) {
	        $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
	    }

	    foreach ($array as $k => $v) {
	        if (is_array($v)) {
	            arrayToXml($v, $k, $_xml->addChild($k));
	        } else {
	            $_xml->addChild($k, $v);
	        }
	    }

	    return $_xml->asXML();
	}

	/**
	 * Transforma o XML em array
	 * 
	 * @param \SimpleXMLElement $parent
	 * @return array
	 */
	public static function XmlToArray(
		SimpleXMLElement $parent
	) {
	    $array = [];

	    foreach ($parent as $name => $element) {
	        ($node = & $array[$name])
	            && (1 === count($node) ? $node = array($node) : 1)
	            && $node = & $node[];

	        $node = $element->count() ? XML2Array($element) : trim($element);
	    }

	    return $array;
	}
}