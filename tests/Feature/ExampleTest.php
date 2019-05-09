<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Suppor;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userblog;
use App\Models\Info;
use App\Models\Article;
class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    private function makeUserBlog(&$user,&$userblog)
    {
        $user = factory(User::class)->create();
        $userblog = $user->userblogs()->save(factory(Userblog::class)->make());
        $info = new Info;
        $info->userblog_id = $userblog->id;
        $user->info()->save($info);
    }
    use DatabaseMigrations;
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

    public function test記事の投稿ページへのテスト()
    {
        $user;
        $userblog;
        makeUserBlog($user, $userblog);
        $response = $this->actingAs($user)->get('/myaccount');
        $response->assertStatus(200);
    }

    public function test記事編集ページへのリクエスト()
    {
      $user;
      $userblog;
      makeUserBlog($user, $userblog);
      $article = $userblog->articles()->save(factory(Article::class)->make());
      $response = $this->actingAs($user)->get(route('myaccount.edit', ["id" => $userblog->id, 'entry_id' => $article->id]));
      $response->assertStatus(200);
    }

    public function testタグついかリクエストのレスポンステスト()
    {
        $response = $this->post("/api/newtag",['newtag' => "dens"]);
        $response->assertStatus(200);
    }

    public function testタグついかリクエストのレスポンステスト失敗()
    {
        $response = $this->post("/api/newtag",['newtag' => "taggggggeee"]);
        $response->assertStatus(302);
    }

}
