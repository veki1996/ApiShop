<?php

namespace App\Helpers;

use DOMDocument;
use DOMNode;

class HtmlHelper
{
    public static function getTagContent(string $identifier, string $html, string $identifierType = 'id'): string
    {
        $domDocument = new DOMDocument();
        @$domDocument->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        $tag = $identifierType === 'id'
            ? $domDocument->getElementById($identifier)
            : $domDocument->getElementsByTagName($identifier)->item(0);
        if (!$tag) {
            return '';
        }

        return self::innerHtml($tag);
    }

    private static function innerHtml(DOMNode $element): string
    {
        $innerHTML = '';
        $children = $element->childNodes;

        foreach ($children as $child) {
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML;
    }
}
