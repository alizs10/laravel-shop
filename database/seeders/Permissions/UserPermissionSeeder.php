<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن کاربران', 'status' => 1],
            ['name' => 'ایجاد کاربر', 'status' => 1],
            ['name' => 'ویرایش کاربر', 'status' => 1],
            ['name' => 'حذف کاربر', 'status' => 1],
            ['name' => 'همه دسترسی ها (کاربران)', 'status' => 1],
        ]);
    }
}
