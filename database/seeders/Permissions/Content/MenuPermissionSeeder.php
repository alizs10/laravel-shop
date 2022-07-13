<?php

namespace Database\Seeders\Permissions\Content;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن منو', 'status' => 1],
            ['name' => 'ایجاد منو', 'status' => 1],
            ['name' => 'ویرایش منو', 'status' => 1],
            ['name' => 'حذف منو', 'status' => 1],
            ['name' => 'همه دسترسی ها (منو)', 'status' => 1],
        ]);
    }
}
