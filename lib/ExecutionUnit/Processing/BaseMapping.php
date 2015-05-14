<?php

namespace ExecutionUnit\Processing;

/**
 * Class BaseMapping
 *
 * @author	Konstantin Ryapolov <kryapolov@yandex.ru>
 * @package ExecutionUnit\Processing
 */
class BaseMapping {

    /**
     * Implenent instance over $params
     *
     * @param array $params
     *
     * @return mixed
     */
    public static function __set_state($params)
    {

        $currentClassName = __CLASS__;
        $instance = new $currentClassName();

        foreach ($params as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->$key = $value;
            } else {
                //TODO @excption ?
            }
        }

        return $instance;
    }

    /**
     * Get array of properties of state
     *
     * @return array
     */
    public function ExportState()
    {
        return get_object_vars($this);
    }

    /**
     * #see http://php.net/manual/en/language.oop5.overloading.php
     * @param $methodName
     * @param $args
     *
     * @return mixed
     * @throws MemberAccessException
     */
    public function __call($methodName, $args)
    {
        if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
            $property = strtolower($matches[2]) . $matches[3];
            if (!property_exists($this, $property)) {
                throw new MemberAccessException('Property ' . $property . ' not exists');
            }
            switch ($matches[1]) {
                case 'set':
                    $this->$property = $args[0];

                    return $this;
                case 'get':
                    return $this->$property;

                case 'default':
                    throw new MemberAccessException('Method ' . $methodName . ' not exists');
            }
        }
    }
}