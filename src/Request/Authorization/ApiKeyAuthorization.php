<?php

namespace Serkancelik17\ApiBase\Request\Authorization;

class ApiKeyAuthorization  extends AuthorizationAbstract implements IAuthorization
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
    public function setKey(string $key): IAuthorization
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
    public function setValue(string $value): IAuthorization
    {
        $this->value = $value;
        return $this;
    }


}
