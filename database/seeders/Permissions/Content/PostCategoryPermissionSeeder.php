<?php

namespace Database\Seeders\Permissions\Content;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategoryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن دسته بندی محتوا', 'status' => 1],
            ['name' => 'ایجاد دسته بندی محتوا', 'status' => 1],
            ['name' => 'ویرایش دسته بندی محتوا', 'status' => 1],
            ['name' => 'حذف دسته بندی محتوا', 'status' => 1],
            ['name' => 'همه دسترسی ها (دسته بندی محتوا)', 'status' => 1],
        ]);
    }
}
