<?php

namespace Entegrator\ApiBase\Response;

trait Util
{
    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $attribute => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            if (!empty($value) OR is_int($value) OR is_bool($value) OR is_array($value)) { // Değer boş degilse.
                if (method_exists($this, $method)) {
                    $this->$method($value);
                } else {
                    $this->$attribute = $value;
                }
            }
        }
    }

}
