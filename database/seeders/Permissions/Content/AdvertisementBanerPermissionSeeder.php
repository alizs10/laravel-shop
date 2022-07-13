<?php

namespace Database\Seeders\Permissions\Content;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisementBanerPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن بنر', 'status' => 1],
            ['name' => 'ایجاد بنر', 'status' => 1],
            ['name' => 'ویرایش بنر', 'status' => 1],
            ['name' => 'حذف بنر', 'status' => 1],
            ['name' => 'همه دسترسی ها (بنر)', 'status' => 1],
        ]);
    }
}
