<?php

namespace Database\Seeders\Permissions\Notify;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SMSPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'ایجاد اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'ویرایش اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'حذف اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'همه دسترسی ها (اطلاعیه های پیامکی)', 'status' => 1],
        ]);
    }
}
