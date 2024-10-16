<?php

namespace Yormy\CoreToolsLaravel\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Yormy\AssertLaravel\Helpers\AssertJsonMacros;
use Yormy\CoreToolsLaravel\CoreToolsLaravelServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        TestConfig::setup();

        $this->withoutExceptionHandling();

        AssertJsonMacros::register();
    }

    /**
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            CoreToolsLaravelServiceProvider::class,
        ];
    }
}
