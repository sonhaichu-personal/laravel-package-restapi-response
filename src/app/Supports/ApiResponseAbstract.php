<?php

namespace HaiCS\Laravel\Api\Response\Supports;

use Illuminate\Contracts\Routing\ResponseFactory;
use League\Fractal\Manager;

abstract class ApiResponseAbstract
{
    /**
     * @var League\Fractal\Manager
     */
    protected $manager;

    /**
     * @var League\Fractal\Manager
     */
    protected $factory;

    /**
     * Constructor
     *
     * @param League\Fractal\Manager $manager
     *
     * @return void
     */
    public function __construct(Manager $manager, ResponseFactory $factory)
    {
        $this->manager = $manager;
        $this->factory = $factory;
    }

    /**
     * Create array structured data
     *
     * @param League\Fractal\Resource\ResourceInterface $resource
     *
     * @return array
     */
    protected function createArrayData($resource): array
    {
        return $this->manager->createData($resource)->toArray();
    }

    /**
     * Return json response
     *
     * @param array $data
     *
     * @return Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $data)
    {
        return $this->factory->json($data);
    }
}
