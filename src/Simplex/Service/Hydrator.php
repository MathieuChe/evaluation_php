<?php

namespace Simplex\Service;


class Hydrator 
{

    /**
     * @param object ou string $object
     * @param array $data
     */

    public static function hydrate($object, array $data)
    {

        if (is_string($object)){
            $object = new $object;
        }

        foreach ($data as $property => $value) {
            $method = 'set'.ucfirst($property);
            if (method_exists($object, $method)) {
                $object->$method($value);
            }
        }
        return $object;
    }
}