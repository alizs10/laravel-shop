<?php

namespace Database\Seeders\Permissions;

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
            ['name' => 'ایجاد اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'ویرایش اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'دیدن اطلاعیه پیامکی', 'status' => 1],
            ['name' => 'حذف اطلاعیه پیامکی', 'status' => 1]
        ]);
    }
}
