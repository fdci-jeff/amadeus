<?php

namespace Jeff\Anadeus\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDump;
use Jeff\Amadeus\Amadeus;

class AmadeusTest extends TestCase
{
    public function testSomething()
    {
        $this->assertTrue(true);
    }

    public function testUrl()
    {
        $this->dump('test');
        $amadeus = new Amadeus;
        
        $response = $amadeus->url();

        $response->assertStatus(200);
        $response->assertSee('Done accessing url');
    }
}