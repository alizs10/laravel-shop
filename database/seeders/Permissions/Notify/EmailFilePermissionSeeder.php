<?php

namespace Database\Seeders\Permissions\Notify;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailFilePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ایجاد فایل اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'ویرایش فایل اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'دیدن فایل اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'حذف فایل اطلاعیه ایمیلی', 'status' => 1],
            ['name' => 'همه دسترسی ها (فایل های اطلاعیه ایمیلی)', 'status' => 1],
        ]);
    }
}
