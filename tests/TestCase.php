<?php

namespace HaiCS\Laravel\Api\Response\Test;

use HaiCS\Laravel\Api\Response\Providers\ApiResponseServiceProvider;
use HaiCS\Laravel\Api\Response\Providers\TestServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return HaiCS\Laravel\Generator\Providers\GeneratorServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [
            ApiResponseServiceProvider::class,
            TestServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../src/database/factories');
    }
}
