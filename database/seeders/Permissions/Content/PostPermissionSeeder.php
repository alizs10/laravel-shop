<?php

namespace Database\Seeders\Permissions\Content;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن پست', 'status' => 1],
            ['name' => 'ایجاد پست', 'status' => 1],
            ['name' => 'ویرایش پست', 'status' => 1],
            ['name' => 'حذف پست', 'status' => 1],
            ['name' => 'همه دسترسی ها (پست)', 'status' => 1],
        ]);
    }
}
