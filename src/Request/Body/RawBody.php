<?php

namespace Entegrator\ApiBase\Request\Body;

use Entegrator\ApiBase\Parameter;

class RawBody implements IBody
{
    private string $contentType = 'text/json';
    /**
     * @param Parameter[] $parameters
     */
    private array $parameters;


    public function __construct(array $parameters)
    {
        $this->setParameters($parameters);
    }


    /**
     * @return string
     */
    public function get(): string
    {
        $parametersArray = [];
        foreach ($this->getParameters() as $parameter) {
            $parametersArray[$parameter->getKey()] = $parameter->getValue();
            }
        $json = json_encode($parametersArray);
        return $json;
    }


    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return RawBody
     */
    public function setParameters(array $parameters): RawBody
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return RawBody
     */
    public function setContentType(string $contentType): RawBody
    {
        $this->contentType = $contentType;
        return $this;
    }


}
