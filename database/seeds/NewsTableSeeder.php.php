<?php

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        factory(News::class,100)->create();
    }
}