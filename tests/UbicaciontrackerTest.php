<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UbicaciontrackerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     *
     * @return void
     */
    public function testUbicaciontracker()
    {
      $response = $this->get('/');
          $response->assertStatus(200);
        $this->get('buque/store');
         $response = $this->get('/');
         $this->assertTrue(true);
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/user', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
