<?php

namespace Julienbourdeau\RouteUsage\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Julienbourdeau\RouteUsage\RouteUsage;
use Julienbourdeau\RouteUsage\RouteUsageServiceProvider;
use Orchestra\Testbench\TestCase;

class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [RouteUsageServiceProvider::class];
    }

    /** @test */
    public function it_can_create_route_usage_entry()
    {
        /** @var RouteUsage $routeUsage */
        $routeUsage = RouteUsage::create([
            'identifier' => sha1('x'),
            'method' => 'GET',
            'path' => '/test',
            'status_code' => 200,
        ]);

        $this->assertTrue($routeUsage->exists);
    }

    /** @test */
    public function it_saves_route_usage_entry_if_response_is_valid()
    {
        Route::get('/', function() {
            return 'It works!';
        });

        $response = $this->get('/');
        $response->assertStatus(200);
        $this->assertEquals(1, RouteUsage::count());

        // 404 shouldn't be logged
        $response = $this->get('/not-found');
        $response->assertStatus(404);
        $this->assertEquals(1, RouteUsage::count());

    }

    /** @test */
    public function it_updates_updatedat_attribute()
    {
        RouteUsage::create([
            'identifier' => ($id = sha1('GET'.'/'.'[Closure]'.'200')),
            'method' => 'GET',
            'path' => '/',
            'status_code' => 200,
            'updated_at' => ($now = now()->subYear(1)),
            'created_at' => $created_at = $now->format('Y-m-d H:i:s'),
        ]);

        Route::get('/', function() {
            return 'It works!';
        });

        $response = $this->get('/');
        $response->assertStatus(200);

        $route = RouteUsage::where('identifier', $id)->first();
        $this->assertGreaterThan(time() - 120, $route->updated_at->getTimestamp());
        $this->assertEquals($created_at, $route->created_at);
    }
}
