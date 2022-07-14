<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن روش ارسال', 'status' => 1],
            ['name' => 'ایجاد روش ارسال', 'status' => 1],
            ['name' => 'ویرایش روش ارسال', 'status' => 1],
            ['name' => 'حذف روش ارسال', 'status' => 1],
            ['name' => 'همه دسترسی ها (روش ارسال)', 'status' => 1],
        ]);
    }
}
