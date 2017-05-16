<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_is_accessible_when_not_logged_in()
    {
        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertSee(config('app.name'));
    }

    /** @test */
    public function it_redirects_to_the_dashboard_when_logged_in()
    {
        $this->signIn();

        $response = $this->get('/');
        $response->assertRedirect(route('dashboard.index'));
    }
}
