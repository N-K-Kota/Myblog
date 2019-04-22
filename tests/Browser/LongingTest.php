<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
class LongingTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create([
          'name' => 'testuser1',
          'email' => 'testuser1@mail.com',
          'password' => 'localhost'
        ]);
        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('/login')
            ->type('email', $user->email)
            ->type('password', $user->password)
            ->press('Login')
            ->waitText('タイトル')
            ->assertPathIs('/createuserblog');
        });
    }
}
