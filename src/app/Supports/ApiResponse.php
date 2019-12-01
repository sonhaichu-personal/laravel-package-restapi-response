<?php

namespace HaiCS\Laravel\Api\Response\Supports;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiResponse
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
     * Item response
     *
     * @param Illuminate\Database\Eloquent\Model $item
     * @param $transformer
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function item(Model $item, $transformer)
    {
        $resource = new Item($item, $transformer);

        $data = $this->createArrayData($resource);

        return $this->jsonResponse($data);
    }

    /**
     * Collection response
     *
     * @param Illuminate\Support\Collection $collection
     * @param $transformer
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function collection(SupportCollection $collection, $transformer)
    {
        $resource = new Collection($collection, $transformer);

        $data = $this->createArrayData($resource);

        return $this->jsonResponse($data);
    }

    /**
     * Paginator response
     *
     * @param Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @param $transformer
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function paginator(LengthAwarePaginator $paginator, $transformer)
    {
        $collection = $paginator->getCollection();

        $resource = new Collection($collection, $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        $data = $this->createArrayData($resource);

        return $this->jsonResponse($data);
    }

    /**
     * Success response
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function success()
    {
        return $this->jsonResponse(['success' => true]);
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
