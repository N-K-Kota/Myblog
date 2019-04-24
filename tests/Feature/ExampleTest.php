<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Suppor;
use Illuminate\Support\Facades\DB;
use App\User;

class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testRoot()
    {
        $response = $this->get('/blogs');
        $response->assertStatus(200);
    }

    public function testMyaccount()
    {
        $response = $this->get('/myaccount');
        $response->assertStatus(302);
    }

  
}
