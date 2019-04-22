<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Article;
use App\User;
use App\Userblog;
use Illuminate\Support\Facades\DB;
class DatabaseTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testTagsdatabase()
    {
        DB::table("tags")->insert(['name' => 'testtag']);
        $this->assertDatabaseHas('tags',['name' => "testtag"]);
    }

    public function testUser()
    {
        factory(User::class)->create([
          'name' => 'test1',
        ]);
        $this->assertDatabaseHas('users',[
          'name' => 'test1',
        ]);
    }
    public function testArticleTest()
    {
        $user = factory(User::class)->create([
          'name' => 'test1',
        ]);
        factory(Userblog::class)->create([
            'title' => 'myblog',
            'user_id' => 1,
            'category' => 1
        ]);
        // DB::table('userblogs')->insert([
        //     'title' => 'myblog',
        //     'user_id' => 1,
        //     'category' => 1
        // ]);
        DB::table("tags")->insert(['name' => 'testtag']);
        DB::table('infos')->insert(['user_id' => 1, 'userblog_id' => 1]);
        $this->actingAs($user)->post('myaccount', ['title' => 'article1', 'article' => 'articlecontent', 'userblog_id' => 1,'id1' => 'testtag', 'newtagnames' => 'new1,new2']);
        $this->assertDatabaseHas('articles',[
            'title' => 'article1',
            'article' => 'articlecontent',
            'userblog_id' => 1
        ]);
        $this->assertDatabaseHas('tags', [
          'name' => 'new1'
        ]);
        $this->assertDatabaseHas('tags', [
          'name' => 'new2'
        ]);
    }


    public function testRelation()
    {
        factory(User::class)->create([
          'name' => 'kota'
        ]);

        factory(Userblog::class)->create(
          [
            'title' => "TEST",
            'category' => 1,
            'user_id'  => 1
          ]
        );
        factory(Article::class)->create(
          [
          'userblog_id' => 1,
          'article' => "testtag",
          ]);
        $this->assertDatabaseHas('articles', ['article' => 'testtag','userblog_id'=>1]);
    }

    public function testUserblog()
    {
        $user = factory(User::class)->create([
          'name' => 'testuser'
        ]);

        $this->actingAs($user)->post('/createuserblog', ['title' => 'user1', 'user_id' => 1, 'category' => 1]);
        $this->assertDatabaseHas('userblogs',['title' => 'user1']);
    }

    


}
