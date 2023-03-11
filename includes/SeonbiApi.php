<?php

use MediaWiki\MediaWikiServices;

class SeonbiApi {
    
    public static function convert($text) {
        $postdata = json_encode(
            array(
                'content' => $text,
                'contentType' => 'text/html',
                'quote' => 'CurvedQuotes',
                'cite' => 'AngleQuotes',
                'arrow' => array(
                    'bidirArrow' => true,
                    'doubleArrow' => true
                ),
                'ellipsis' => true,
                'emDash' => true,
                'quote' => 'CurvedQuotes',
                'stop' => 'Vertical'
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
        $config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'seonbi' );
        $apiUrl = $config->get('SeonbiApiUrl');
        $result = file_get_contents($apiUrl, false, $context);
        $json = json_decode($result, true);
        return $json['resultHtml'];
    }

}