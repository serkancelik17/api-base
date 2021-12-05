<?php
include "vendor/autoload.php";

class NewRequest extends Entegrator\ApiBase\Request\BaseRequest implements Entegrator\ApiBase\Request\IRequest {

    public function __construct(\Entegrator\ApiBase\Request\Header $header, \Entegrator\ApiBase\Request\Authorization\AuthorizationInterface $authorization, \Entegrator\ApiBase\Request\Url $url, \Entegrator\ApiBase\Request\Body\BodyInterface $body = null)
    {
        parent::__construct($header, $authorization, $url, $body);
    }

    function createAuthorization(): \Entegrator\ApiBase\Request\Authorization\AuthorizationInterface
    {
       return new Entegrator\ApiBase\Request\Authorization\BasicAuthorizationInterface('xxx','yyy');
    }

    function createHeader(): \Entegrator\ApiBase\Request\Header
    {
        return new \Entegrator\ApiBase\Request\Header();
    }
}
$url = new \Entegrator\ApiBase\Request\Url("https://api.trendyol.com","suppliers/104967/orders","sapigw");
$authorization = new \Entegrator\ApiBase\Request\Authorization\BasicAuthorizationInterface( "zpEYe8qpnB6g05D34IwK","OLRyhXRHmEUIjuvWJgxG");
$request = new NewRequest(new \Entegrator\ApiBase\Request\Header(),
    $authorization,
    $url);

var_dump($request->runWithCurl());
