<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserblogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('userblogs')->insert(
            [
                'title' => 'What a Wonderful World',
                'category' => 1,
                'user_id' => 1
            ]
          );
    }
}
