<?php

namespace Julienbourdeau\RouteUsage\Tests;

use Julienbourdeau\RouteUsage\RouteUsageServiceProvider;
use Orchestra\Testbench\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BaseIntegrationTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [RouteUsageServiceProvider::class];
    }
}
