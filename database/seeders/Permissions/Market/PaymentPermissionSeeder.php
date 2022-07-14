<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن پرداخت', 'status' => 1],
            ['name' => 'ایجاد پرداخت', 'status' => 1],
            ['name' => 'ویرایش پرداخت', 'status' => 1],
            ['name' => 'حذف پرداخت', 'status' => 1],
            ['name' => 'همه دسترسی ها (پرداخت)', 'status' => 1],
        ]);
    }
}
