<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ایجاد اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'ویرایش اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'دیدن اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'حذف اطلاعیه ایمیلی', 'status' => 1]
        ]);
    }
}
