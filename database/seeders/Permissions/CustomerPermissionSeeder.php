<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ایجاد مشتری', 'status' => 1],
            ['name' => 'ویرایش مشتری', 'status' => 1],
            ['name' => 'دیدن مشتری ها', 'status' => 1],
            ['name' => 'حذف مشتری', 'status' => 1]
        ]);
    }
}
