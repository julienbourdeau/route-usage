<?php

namespace Julienbourdeau\RouteUsage\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Julienbourdeau\RouteUsage\RouteUsage;

/**
 * @internal
 * @coversNothing
 */
class IntegrationTest extends BaseIntegrationTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/', function () {
            return 'It works!';
        });
    }

    /** @test */
    public function itCanCreateRouteUsageEntry()
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
    public function itSavesRouteUsageEntryIfResponseIsValid()
    {

        $response = $this->get('/');
        $response->assertStatus(200);
        $this->assertEquals(1, RouteUsage::count());

        // 404 shouldn't be logged
        $response = $this->get('/not-found');
        $response->assertStatus(404);
        $this->assertEquals(1, RouteUsage::count());
    }

    /** @test */
    public function itUpdatesUpdatedatAttribute()
    {
        RouteUsage::create([
            'identifier' => ($id = sha1('GET' . '/' . '[Closure]' . '200')),
            'method' => 'GET',
            'path' => '/',
            'status_code' => 200,
            'updated_at' => ($now = now()->subYear(1)),
            'created_at' => $created_at = $now->format('Y-m-d H:i:s'),
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);

        $route = RouteUsage::where('identifier', $id)->first();
        $this->assertGreaterThan(time() - 120, $route->updated_at->getTimestamp());
        $this->assertEquals($created_at, $route->created_at);
    }

    /** @test */
    public function itIgnoresOptionsHttpRequest()
    {
        $response = $this->call('OPTIONS', '/');
        $response->assertStatus(200);

        $this->assertEquals(0, RouteUsage::count());
    }

    /** @test */
    public function itIgnoresRoutesBasedOnConfig()
    {
        config(['route-usage' => [
            'excluding-regex' => [
                'name' => '/^nope\./',
                'uri' => '/ignore/'
            ]
        ]]);
        Route::get('/ok', function () { return 'OK'; })->name('nope.index');
        Route::get('/ignore', function () { return 'KO'; });

        $this->get('/ok');
        $this->get('/ignore');
        $this->assertEquals(0, RouteUsage::count());

        $this->get('/');
        $this->assertEquals(1, RouteUsage::count());
    }
}
