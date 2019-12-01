<?php

namespace HaiCS\Laravel\Api\Response\Test\Unit;

use HaiCS\Laravel\Api\Response\Test\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;

class CollectionTest extends TestCase
{
    /**
     * @test
     */
    public function can_paginate_standard_collection()
    {
        $data = [
            1,
            2,
            3,
            4,
            5,
        ];

        $result = collect($data)->paginate(3);

        $this->assertTrue($result instanceof LengthAwarePaginator);
    }
}
