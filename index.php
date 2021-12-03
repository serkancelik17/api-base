<?php
include "vendor/autoload.php";

class NewRequest extends Entegrator\ApiBase\Request\BaseRequest implements Entegrator\ApiBase\Request\IRequest {

    public function __construct(\Entegrator\ApiBase\Request\Header $header, \Entegrator\ApiBase\Request\Authorization\IAuthorization $authorization, \Entegrator\ApiBase\Request\Url $url, \Entegrator\ApiBase\Request\Body\IBody $body = null)
    {
        parent::__construct($header, $authorization, $url, $body);
    }

    function createAuthorization(): \Entegrator\ApiBase\Request\Authorization\IAuthorization
    {
       return new Entegrator\ApiBase\Request\Authorization\BasicAuthorization('xxx','yyy');
    }

    function createHeader(): \Entegrator\ApiBase\Request\Header
    {
        return new \Entegrator\ApiBase\Request\Header();
    }
}
$url = new \Entegrator\ApiBase\Request\Url("https://api.trendyol.com","suppliers/104967/orders","sapigw");
$authorization = new \Entegrator\ApiBase\Request\Authorization\BasicAuthorization( "zpEYe8qpnB6g05D34IwK","OLRyhXRHmEUIjuvWJgxG");
$request = new NewRequest(new \Entegrator\ApiBase\Request\Header(),
    $authorization,
    $url);

var_dump($request->runWithCurl());
