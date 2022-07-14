<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن سفارش', 'status' => 1],
            ['name' => 'ایجاد سفارش', 'status' => 1],
            ['name' => 'ویرایش سفارش', 'status' => 1],
            ['name' => 'حذف سفارش', 'status' => 1],
            ['name' => 'همه دسترسی ها (سفارش)', 'status' => 1],
        ]);
    }
}
