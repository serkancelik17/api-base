<?php
namespace Entegrator\ApiBase\Abstracts;


use Entegrator\ApiBase\Response\Util;
use Entegrator\TrendyolApi\V1\Interfaces\RequestInterface;

abstract class ResponseAbstract
{
    Use Util;

    public function __construct(RequestInterface $request)
    {
        $body = $request->run();

        $data = json_decode($body, true);

            $this->hydrate($data);
    }

    /**
     * @return bool
     */
    public function isArray(): bool
    {
        return $this->isArray;
    }

    /**
     * @param bool $isArray
     * @return ResponseAbstract
     */
    public function setIsArray(bool $isArray): ResponseAbstract
    {
        $this->isArray = $isArray;
        return $this;
    }


}
