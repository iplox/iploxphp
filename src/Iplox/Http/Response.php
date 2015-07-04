<?php

namespace Iplox\Http;
use Iplox\Http\StatusCode;

class Response
{
    protected static $current;
    public $contentType;
    public $body;
    public $statusCode;

    public function __construct($body, $contentType, $statusCode = StatusCode::OK)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->contentType = $contentType;
    }

    public static function getCurrent()
    {
        if(null === static::$current){
            static::$current = new Request();
        }

        return static::$current;
    }

    public function toJson()
    {
        return \json_encode($this->body);
    }

    public function toXml()
    {
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive($this->body, array ($xml, 'addChild'));
        return $xml->asXML();
    }

    public function end()
    {
        header('Content-type: '.$this->contentType);
        http_response_code($this->statusCode);
        if($this->contentType = 'application/json') {
            echo $this->toJson();
        } elseif($this->contentType = 'application/xml'){
            echo $this->toXml();
        } elseif($this->contentType = 'application/array') {
            return $this->data;
        } else {
            echo $this->body;
        }
        exit();
    }
}