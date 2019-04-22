<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Suppor;
use Illuminate\Support\Facades\DB;
use App\User;

class ExampleTest extends TestCase
{

  use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testArticleTest()
    {

        $response = $this->get('/blogs');
        $response->assertStatus(200);
    }

    public function testviewuserblog()
    {
        $response = $this->get('/createuserblog');
        $response->assertStatus(200);
    }

    public function testAccountTest()
    {
        $response = $this->get('/myaccount');
        $response->assertStatus(302);
    }

    public function testユーザーブログを作成する()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser'
        ]);
        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog','user_id' => 1,'category' => 1]);

        $this->assertDatabaseHas('userblogs',[
            'title' => 'testblog'
        ]);
    }
    public function testユーザーブログを複数作れるか()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser'
        ]);
        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog','user_id' => 1,'category' => 1]);
        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog','user_id' => 1,'category' => 1]);
        $user = User::withCount('userblogs')->first();
        $this->assertEquals(2,$user->userblogs_count);
    }

    public function testinfoが更新されるか()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser'
        ]);
        $user->info()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog','user_id' => 1,'category' => 1]);
        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog2','user_id' => 1,'category' => 1]);
        $this->assertDatabaseHas('infos', ['userblog_id' => 2]);
    }
    public function testユーザーブログ選択したら反映されるか()
    {
        $user = factory(User::class)->create(['name' => 'testuser']);
        $user->info()->create(['blog_id' => 1]);

        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog','user_id' => 1,'category' => 1]);
        $response = $this->actingAs($user)->post('/createuserblog',['title' => 'testblog2','user_id' => 1,'category' => 1]);

        $response = $this->actingAs($user)->post('/myaccount/manage/2', ['id' => 1,'userblog_id' => 1]);
        $this->assertEquals(1, $user->info->userblog_id);
    }
}
