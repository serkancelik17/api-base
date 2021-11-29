<?php

namespace ApiBase\Models;

class Parameter
{
    private string $key;
    private string $value;

    public function __construct(string $key, string $value)
    {
        $this->setKey($key)->setValue($value);
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
     * @return Parameter
     */
    public function setKey(string $key): Parameter
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
     * @return Parameter
     */
    public function setValue(string $value): Parameter
    {
        $this->value = $value;
        return $this;
    }

    public function toArray(): array
    {
        return [$this->getKey() => $this->getValue()];
    }



}
