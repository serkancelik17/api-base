<?php
namespace ApiBase\Response;

use ApiBase\Request\IRequest;

abstract class BaseResponse
{
    Use Util;

    public function __construct(IRequest $request)
    {

        $body = $request->run();

        $data = json_decode($body, true);

        $this->hydrate($data);
    }
}