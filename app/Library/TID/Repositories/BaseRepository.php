<?php

namespace TID\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

use TID\Repositories\Param\ParameterBag;
use TID\Repositories\Param\Collector as ParamCollector;

use Exception;

abstract class BaseRepository
{
    protected $app;
    protected $model;

    /**
     * [$paramCollection description]
     * @var App\Repositories\Param\ParameterBag
     */
    protected $paramCollection;

    abstract public function model();

    /**
     * Construct repo
     *
     * @param App            $app
     * @param ParamCollector $paramCollection
     */
    public function __construct(App $app, ParamCollector $paramCollection)
    {
        $this->app = $app;
        $this->paramCollection = $paramCollection;

        $this->makeModel();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws Exception
     */
    public function makeModel()
    {
        return $this->setModel($this->model());
    }

    /**
     * Set Eloquent Model to instantiate
     *
     * @param  $eloquentModel
     * @return Model
     * @throws Exception
     */
    public function setModel($eloquentModel)
    {
        $this->model = $this->app->make($eloquentModel);

        if (!$this->model instanceof Model) {
            throw new Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model;
    }

    /**
     * Set the repo paramaters to work with
     * If not set and not in cli mode, the parameter bag will contain all request params
     *
     * @param array $parameters array with foo
     * @return void
     */
    public function setRepoParameters(array $parameters = [])
    {
        // overwrite all existing params
        $this->paramCollection->setParameters($parameters);
    }

    /**
     * Helper method to fetch the param bag from the param collector
     *
     * @return ParameterBag
     */
    public function params()
    {
        return $this->paramCollection->getParameterBag();
    }

    public function find($key, array $with = [], $columns = ['*'])
    {
        $this->makeModel();

        return $this->model->with($with)
            ->find($key, $columns);
    }

    /**
     * Find many entities by whereIn
     *
     * @param string $key
     * @param string $whereIn
     * @param array $with
     */
    public function findWhereIn($key, array $whereIn = [], array $with = [], $columns = ['*'])
    {
        $this->makeModel();

        return $this->model->with($with)
            ->whereIn($key, $whereIn)
            ->get($columns);
    }
}
