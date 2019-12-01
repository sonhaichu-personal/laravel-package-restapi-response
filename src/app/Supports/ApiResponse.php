<?php

namespace HaiCS\Laravel\Api\Response\Supports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiResponse
{
    /**
     * @var League\Fractal\Manager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param League\Fractal\Manager $manager
     *
     * @return void
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Item response
     *
     * @param Illuminate\Database\Eloquent\Model $item
     * @param $transformer
     *
     * @return string
     */
    public function item(Model $item, $transformer): string
    {
        $resource = new Item($item, $transformer);

        return $this->manager->createData($resource)->toJson();
    }

    /**
     * Collection response
     *
     * @param Illuminate\Support\Collection $collection
     * @param $transformer
     *
     * @return string
     */
    public function collection(SupportCollection $collection, $transformer): string
    {
        $resource = new Collection($collection, $transformer);

        return $this->manager->createData($resource)->toJson();
    }
}
