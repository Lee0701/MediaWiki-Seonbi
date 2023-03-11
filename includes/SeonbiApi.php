<?php

use MediaWiki\MediaWikiServices;

class SeonbiApi {
    
    public static function convert($text) {
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'seonbi' );
        $apiUrl = $config->get('SeonbiApiUrl');

        $arrow = null;
        if($config->get('SeonbiArrow')) $arrow = array(
            'bidirArrow' => $config->get('SeonbiBidirArrow'),
            'doubleArrow' => $config->get('SeonbiDoubleArrow')
        );

        $postdata = json_encode(
            array(
                'content' => $text,
                'contentType' => 'text/html',
                'quote' => $config->get('SeonbiQuote'),
                'cite' => $config->get('SeonbiCite'),
                'arrow' => $arrow,
                'ellipsis' => $config->get('SeonbiEllipsis'),
                'emDash' => $config->get('SeonbiEmDash'),
                'stop' => $config->get('SeonbiStop')
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($apiUrl, false, $context);
        $json = json_decode($result, true);
        return $json['resultHtml'];
    }

}