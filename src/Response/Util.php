<?php

namespace ApiBase\Response;

trait Util
{
    public function hydrate($data)
    {
        foreach ($data as $attribute => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            if (method_exists($this,$method)) {
                $this->$method($value);
            } else {
                $this->$attribute = $value;
            }
        }
    }

}
