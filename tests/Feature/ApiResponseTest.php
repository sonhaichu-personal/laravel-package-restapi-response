<?php

namespace HaiCS\Laravel\Api\Response\Test\Feature;

use HaiCS\Laravel\Api\Response\Test\TestCase;

class ApiResponseTest extends TestCase
{
    /**
     * @test
     */
    public function can_retrieve_json_item()
    {
        $response = $this->get('api/v1/books/detail');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => ['title', 'description', 'author'],
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_collection()
    {
        $response = $this->get('api/v1/books/all');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [],
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_paginator()
    {
        $response = $this->get('api/v1/books');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_success()
    {
        $response = $this->get('api/v1/success');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
    }
}
