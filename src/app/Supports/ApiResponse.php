<?php

namespace HaiCS\Laravel\Api\Response\Supports;

use HaiCS\Laravel\Api\Response\Supports\ApiResponseAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiResponse extends ApiResponseAbstract
{
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
}
