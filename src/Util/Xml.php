<?php

declare(strict_types=1);

namespace Projom\Util;

use DOMDocument;
use DOMElement;

class Xml
{
    public static function encode(
        array $toEncode,
        string $rootNodeName
    ): string {

        if (!$toEncode)
            return '';

        /*
        * This is a rather naive approach to solving this issue.
        * Theres an assumption: the $toEncode will have one "master"-key.
        * Any other parallell entries will be lost.
        */
        if (!$rootNodeName) {
            $rootNodeName = array_key_first($toEncode);
            $toEncode = array_shift($toEncode);
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        #$dom->formatOutput = false;
        #$dom->preserveWhiteSpace = false;

        $rootNode = $dom->createElement($rootNodeName);
        static::traverse($toEncode, $rootNode);
        $dom->appendChild($rootNode);

        $result = $dom->saveXML();
        if ($result === false)
            return '';

        return $result;
    }

    public static function traverse(
        array $toEncode,
        DOMElement $rootNode
    ): void {

        foreach ($toEncode as $key => $value) {
            if (is_array($value)) {
                $node = new DOMElement((string)$key);
                $rootNode->appendChild($node);
                static::traverse($value, $node);
            } else {
                $node = new DOMElement((string)$key, (string)$value);
                $rootNode->appendChild($node);
            }
        }
    }
}
