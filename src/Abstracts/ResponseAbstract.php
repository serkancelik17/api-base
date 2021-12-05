<?php
namespace Entegrator\ApiBase\Abstracts;


use Entegrator\ApiBase\Response\Util;

abstract class ResponseAbstract
{
    Use Util;

    public function __construct(RequestAbstract $request)
    {

        $body = $request->run();

        $data = json_decode($body, true);

        $this->hydrate($data);
    }
}
