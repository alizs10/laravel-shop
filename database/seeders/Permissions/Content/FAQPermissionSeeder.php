<?php

namespace Database\Seeders\Permissions\Content;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن سوالات متداول', 'status' => 1],
            ['name' => 'ایجاد سوالات متداول', 'status' => 1],
            ['name' => 'ویرایش سوالات متداول', 'status' => 1],
            ['name' => 'حذف سوالات متداول', 'status' => 1],
            ['name' => 'همه دسترسی ها (سوالات متداول)', 'status' => 1],
        ]);
    }
}
