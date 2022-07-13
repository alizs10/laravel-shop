<?php

namespace Database\Seeders\Permissions\Content;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن پیج', 'status' => 1],
            ['name' => 'ایجاد پیج', 'status' => 1],
            ['name' => 'ویرایش پیج', 'status' => 1],
            ['name' => 'حذف پیج', 'status' => 1],
            ['name' => 'همه دسترسی ها (پیج)', 'status' => 1],
        ]);
    }
}
