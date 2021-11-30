<?php
include "vendor/autoload.php";

class NewRequest extends Serkancelik17\ApiBase\Request\BaseRequest implements Serkancelik17\ApiBase\Request\IRequest {

    public function __construct(\Serkancelik17\ApiBase\Request\Header $header, \Serkancelik17\ApiBase\Request\Authorization\IAuthorization $authorization, \Serkancelik17\ApiBase\Request\Url $url, \Serkancelik17\ApiBase\Request\Body\IBody $body = null)
    {
        parent::__construct($header, $authorization, $url, $body);
    }

    function createAuthorization(): \Serkancelik17\ApiBase\Request\Authorization\IAuthorization
    {
       return new Serkancelik17\ApiBase\Request\Authorization\BasicAuthorization('xxx','yyy');
    }

    function createHeader(): \Serkancelik17\ApiBase\Request\Header
    {
        return new \Serkancelik17\ApiBase\Request\Header();
    }
}
$url = new \Serkancelik17\ApiBase\Request\Url("https://api.trendyol.com","suppliers/104967/orders","sapigw");
$authorization = new \Serkancelik17\ApiBase\Request\Authorization\BasicAuthorization( "zpEYe8qpnB6g05D34IwK","OLRyhXRHmEUIjuvWJgxG");
$request = new NewRequest(new \Serkancelik17\ApiBase\Request\Header(),
    $authorization,
    $url);

var_dump($request->runWithCurl());
