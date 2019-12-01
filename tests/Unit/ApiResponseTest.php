<?php

namespace HaiCS\Laravel\Api\Response\Test\Unit;

use HaiCS\Laravel\Api\Response\Supports\ApiResponse;
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
}
