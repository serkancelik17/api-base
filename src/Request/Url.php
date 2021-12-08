<?php

namespace Entegrator\ApiBase\Request;

use Entegrator\ApiBase\Interfaces\QueryParameterInterface;

class Url
{

    private string $url;
    private string $endPoint;
    private string|null $prefix;
    private QueryParameterInterface|null $queryParameter;

    /**
     * @param string $url
     * @param string $endPoint
     */
    public function __construct(string $url, string $endPoint, string $prefix=null, QueryParameterInterface $queryParameter = null)
    {
        $this->url = $url;
        $this->prefix = $prefix;
        $this->endPoint = $endPoint;
        $this->queryParameter = $queryParameter;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Url
     */
    public function setUrl(string $url): Url
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndPoint(): string
    {
        return $this->endPoint;
    }

    /**
     * @param string $endPoint
     * @return Url
     */
    public function setEndPoint(string $endPoint): Url
    {
        $this->endPoint = $endPoint;
        return $this;
    }

    public function getQueryParameter(): QueryParameterInterface|null
    {
        return $this->queryParameter;
    }

    /**
     * @param QueryParameterInterface $queryParameter
     * @return Url
     */
    public function setQueryParameter(QueryParameterInterface $queryParameter): Url
    {
        $this->queryParameter = $queryParameter;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrefix(): string|null
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return Url
     */
    public function setPrefix(string $prefix): Url
    {
        $this->prefix = $prefix;
        return $this;
    }


    public function __toString() : string {
        $queryParameterString = (string) $this->queryParameter;
        $queryParameter = strlen($queryParameterString) ? "?".$queryParameterString : null;
        $url = $this->getUrl().(($this->getPrefix()) ? $this->getPrefix() : null).$this->getEndPoint().$queryParameter;
        print_r($url);
        return $url;
    }


}
