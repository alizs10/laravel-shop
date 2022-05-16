<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ایجاد ادمین', 'status' => 1],
            ['name' => 'ویرایش ادمین', 'status' => 1],
            ['name' => 'دیدن ادمین ها', 'status' => 1],
            ['name' => 'حذف ادمین', 'status' => 1]
        ]);
    }
}
