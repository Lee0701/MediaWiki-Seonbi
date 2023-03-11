<?php

use MediaWiki\MediaWikiServices;
use MediaWiki\Linker\LinkRenderer;
use MediaWiki\Linker\LinkTarget;

require_once('SeonbiApi.php');

class SeonbiHooks {
    public static function onParserAfterTidy( Parser $parser, &$text ) {
        // $text = SeonbiApi::convert($text);
    }
    public static function onOutputPageBeforeHTML( OutputPage $out, &$text ) {
        $text = SeonbiApi::convert($text);
    }
}

?>
