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
    public function getState()
    {
        return get_object_vars($this);
    }
}