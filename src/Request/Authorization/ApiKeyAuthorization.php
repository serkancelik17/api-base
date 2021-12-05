<?php

namespace Entegrator\ApiBase\Request\Authorization;

use Entegrator\ApiBase\Abstracts\AuthorizationAbstract;
use Entegrator\ApiBase\Interfaces\AuthorizationInterface;

class ApiKeyAuthorization  extends AuthorizationAbstract implements AuthorizationInterface
{
    private string $key;
    private string $value;

    /**
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key, string $value)
    {
        $this->setKey($key);
        $this->setValue($value);

    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return BasicAuthorization
     */
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return BasicAuthorization
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }


}
