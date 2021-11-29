<?php

namespace ApiBase\Request;

use ApiBase\Models\Parameter;

class Header {
    /** @var Parameter[] */
    private array $parameters;

    /**
     * @param Parameter[] $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }


    /**
     * @return Parameter[]
     */
    public function getParameters(bool $isArray = false): array
    {
        if($isArray) {
            $parameters = [];
            foreach ( $this->parameters AS $param) {
              $parameters = array_merge($parameters,$param->toArray());
            }
            return $parameters;
        }
        return $this->parameters;
    }

    /**
     * @param Parameter[] $parameters
     * @return Header
     */
    public function setParameters(array $parameters): Header
    {
        $this->parameters = $parameters;
        return $this;
    }

}
