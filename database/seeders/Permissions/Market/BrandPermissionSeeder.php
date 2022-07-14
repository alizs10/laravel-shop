<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن برند', 'status' => 1],
            ['name' => 'ایجاد برند', 'status' => 1],
            ['name' => 'ویرایش برند', 'status' => 1],
            ['name' => 'حذف برند', 'status' => 1],
            ['name' => 'همه دسترسی ها (برند)', 'status' => 1],
        ]);
    }
}
