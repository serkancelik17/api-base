<?php

namespace ApiBase\Request\Body;

use ApiBase\Models\Parameter;
use App\Request\Body\IBody;

class XWwwFormUrlEncodedBody extends RawBody implements IBody
{

    private string $contentType = 'application/x-www-form-urlencoded';

    /**
     * @param Parameter[] $parameters
     */
    private array $parameters;


    public function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }


    /**
     * @return string
     */
    public function get(): string
    {
        $parametersStringsArray = [];
        foreach ($this->getParameters() as $parameter) {
            $parametersStringsArray[] = $parameter->getKey()."=".$parameter->getValue();
            }
        return implode("&",$parametersStringsArray);

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
