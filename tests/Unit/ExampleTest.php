<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_route_not_found_returns_json()
    {
        $r = $this->get('api/v1/event/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx/default.counter');

        $this->assertEquals(404, $r->json()['status']);
    }
}
