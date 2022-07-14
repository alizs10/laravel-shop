<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن کوپن تخفیف', 'status' => 1],
            ['name' => 'ایجاد کوپن تخفیف', 'status' => 1],
            ['name' => 'ویرایش کوپن تخفیف', 'status' => 1],
            ['name' => 'حذف کوپن تخفیف', 'status' => 1],
            ['name' => 'همه دسترسی ها (کوپن تخفیف)', 'status' => 1],
        ]);
    }
}
