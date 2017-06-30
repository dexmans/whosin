<?php

namespace TID\Repositories\Param;

use Symfony\Component\HttpFoundation\ParameterBag as SymfonyParameterBag;

/**
 * Parameter bag class used by the Repository
 *
 * In every way this mimics the usage of working with Request data
 */
class ParameterBag extends SymfonyParameterBag
{
    /**
     * Returns a parameter by name, supports dot notation
     *
     * @param string $key     The key
     * @param mixed  $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_get($this->parameters, $key, $default);
    }

    /**
     * Returns true if the parameter is defined, supports dot notation
     *
     * @param string $key The key
     *
     * @return bool true if the parameter exists, false otherwise
     */
    public function has($key)
    {
        return array_has($this->parameters, $key);
    }
}
