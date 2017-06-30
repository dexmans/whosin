<?php

namespace TID\Repositories\Param;

use TID\Repositories\Param\ParameterBag;

use App;
use Request;

/**
 * Parameter bag class used by the Repository
 *
 * In every way this mimics the usage of working with Request data, so yeah...
 */
class Collector
{
    private $parameterBag;

    /**
     * Create Collector and collect
     *
     * @param ParameterBag $parameterBag [description]
     */
    public function __construct(ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;

        $this->collect();
    }

    /**
     * Check if we are running in cli or not, if not (HTTP Req) only set request
     * vars when dealing with GET methods
     *
     * @return void
     */
    private function collect()
    {
        // If not in CLI, fetch request data
        if (! App::runningInConsole() && Request::isMethod('get')) {
            $this->setParameters(Request::all());
        }
    }

    /**
     * Set params for bag
     *
     * @param array $parameters [description]
     * @return void
     */
    public function setParameters(array $parameters = [])
    {
        // overwrite all existing
        $this->parameterBag = new ParameterBag($parameters);
    }

    /**
     * Get params bag object
     * @return ParameterBag
     */
    public function getParameterBag()
    {
        return $this->parameterBag;
    }
}
