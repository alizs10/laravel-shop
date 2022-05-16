<?php

namespace Database\Seeders\Permissions;

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
            ['name' => 'ایجاد پیج', 'status' => 1],
            ['name' => 'ویرایش پیج', 'status' => 1],
            ['name' => 'دیدن پیج', 'status' => 1],
            ['name' => 'حذف پیج', 'status' => 1]
        ]);
    }
}
