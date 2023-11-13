<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory(30)->create();
        $statues = DB::table(Status::$tableName)->insert(Status::firstValues());
    }
}
