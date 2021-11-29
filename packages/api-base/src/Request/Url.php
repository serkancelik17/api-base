<?php

namespace ApiBase\Request;

use ApiBase\Request\QueryParameter\IQueryParameter;

class Url
{

    private string $url;
    private string $endPoint;
    private string|null $prefix;
    private IQueryParameter|null $queryParameter;

    /**
     * @param string $url
     * @param string $endPoint
     */
    public function __construct(string $url,string $endPoint,string $prefix=null,IQueryParameter $queryParameter = null)
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

    public function getQueryParameter(): IQueryParameter|null
    {
        return $this->queryParameter;
    }

    /**
     * @param IQueryParameter $queryParameter
     * @return Url
     */
    public function setQueryParameter(IQueryParameter $queryParameter): Url
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


    public function get() {
        $queryParameter = strlen($this->queryParameter) ? "?".$this->getQueryParameter() : null;
        $url = $this->getUrl()."/".(($this->getPrefix()) ? $this->getPrefix()."/" : null).$this->getEndPoint().$queryParameter;
        print_r($url);
        return $url;
    }


}
