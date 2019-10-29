<?php

namespace Julienbourdeau\RouteUsage\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Julienbourdeau\RouteUsage\RouteUsage;

/**
 * @internal
 * @coversNothing
 */
class RouteUsageControllerTest extends BaseIntegrationTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures();

        Gate::shouldReceive('check')
            ->with('viewRouteUsage', \Mockery::any())
            ->andReturnTrue();
    }

    /** @test */
    public function itShowsTableHtmlPage()
    {
        $response = $this->get(route('route-usage.index'));
        $response->assertStatus(200);
        $this->assertEquals(3, $response->viewData('routes')->count());

        // When there is no data
        DB::table('route_usage')->truncate();
        $response = $this->get(route('route-usage.index'));
        $response->assertStatus(200);
        $this->assertContains('No routes found.', $response->content());
    }

    /** @test */
    public function itCanSortByStatusCode()
    {
        $response = $this->get(route('route-usage.index', [
            'orderBy' => 'status_code',
            'sort' => 'desc',
        ]));

        $this->assertEquals(302, $response->viewData('routes')->first()->status_code);

        $response = $this->get(route('route-usage.index', [
            'orderBy' => 'status_code',
            'sort' => 'asc',
        ]));

        $this->assertEquals(200, $response->viewData('routes')->first()->status_code);
    }

    /** @test */
    public function itSortsByLeastRecentlyUsedByDefault()
    {
        $response = $this->get(route('route-usage.index', [
            'orderBy' => 'yolo',
            'sort' => 'snafu',
        ]));

        $orderedPath = $response->viewData('routes')->pluck('path')->reject('route-usage')->toArray();

        $this->assertEquals(['/yolo', '/', '/home'], $orderedPath);
    }

    private function loadFixtures()
    {
        RouteUsage::create([
            'identifier' => sha1('GET'.'/'.'[Closure]'.'200'),
            'method' => 'GET',
            'path' => '/',
            'status_code' => 200,
            'updated_at' => ($now = now()->subDays(3)),
            'created_at' => $now->format('Y-m-d H:i:s'),
        ]);

        RouteUsage::create([
            'identifier' => sha1('POST'.'/yolo'.'[Closure]'.'302'),
            'method' => 'POST',
            'path' => '/yolo',
            'status_code' => 302,
            'updated_at' => $created_at = now()->subYear(1),
            'created_at' => $created_at,
        ]);

        RouteUsage::create([
            'identifier' => sha1('GET'.'/home'.'HomeController@index'.'200'),
            'method' => 'GET',
            'path' => '/home',
            'status_code' => 201,
            'updated_at' => now()->subHours(2),
            'created_at' => $created_at,
        ]);
    }
}
