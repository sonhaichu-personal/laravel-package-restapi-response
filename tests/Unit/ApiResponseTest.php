<?php

namespace HaiCS\Laravel\Api\Response\Test\Unit;

use HaiCS\Laravel\Api\Response\Supports\ApiResponse;
use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Book;
use HaiCS\Laravel\Api\Response\Test\Stubs\Transformers\BookTransformer;
use HaiCS\Laravel\Api\Response\Test\TestCase;
use Illuminate\Http\Response;

class ApiResponseTest extends TestCase
{
    /**
     * @test
     */
    public function can_access_api_function_in_standard_response()
    {
        $response = response()->api();

        $this->assertTrue($response instanceof ApiResponse);
    }

    /**
     * @test
     */
    public function can_response_item_with_transformer()
    {
        $item        = factory(Book::class)->make();
        $transformer = new BookTransformer();

        $response = response()->api()->item($item, $transformer);
        $data     = json_decode($response, true);

        $this->assertArrayHasKey('data', $data);
        $this->assertSame($data['data']['title'], $item->title);
        $this->assertSame($data['data']['description'], $item->description);
        $this->assertSame($data['data']['author'], $item->author);
    }

    /**
     * @test
     */
    public function can_response_collection_with_transformer()
    {
        $collection  = factory(Book::class, 5)->make();
        $transformer = new BookTransformer();

        $response = response()->api()->collection($collection, $transformer);
        $data     = json_decode($response, true);

        $this->assertArrayHasKey('data', $data);
        $this->assertCount($collection->count(), $data['data']);

        $collection->each(function ($item, $key) use ($data) {
            $this->assertSame($item->title, $data['data'][$key]['title']);
            $this->assertSame($item->description, $data['data'][$key]['description']);
            $this->assertSame($item->author, $data['data'][$key]['author']);
        });
    }

    /**
     * @test
     */
    public function can_response_paginator_with_transformer()
    {
        $collection  = factory(Book::class, 5)->make();
        $paginator   = $collection->paginate(3);
        $transformer = new BookTransformer();

        $response = response()->api()->paginator($paginator, $transformer);
        $data     = json_decode($response, true);

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('meta', $data);
        $this->assertArrayHasKey('pagination', $data['meta']);
        $this->assertArrayHasKey('total', $data['meta']['pagination']);
        $this->assertArrayHasKey('count', $data['meta']['pagination']);
        $this->assertArrayHasKey('per_page', $data['meta']['pagination']);
        $this->assertArrayHasKey('current_page', $data['meta']['pagination']);
        $this->assertArrayHasKey('total_pages', $data['meta']['pagination']);
        $this->assertArrayHasKey('links', $data['meta']['pagination']);

        $this->assertSame($paginator->total(), $data['meta']['pagination']['total']);
        $this->assertSame($paginator->count(), $data['meta']['pagination']['count']);
        $this->assertSame($paginator->perPage(), $data['meta']['pagination']['per_page']);
        $this->assertSame($paginator->currentPage(), $data['meta']['pagination']['current_page']);
    }
}
