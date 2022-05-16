<?php

namespace Database\Seeders\Permissions;

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
            ['name' => 'ایجاد دسته بندی', 'status' => 1],
            ['name' => 'ویرایش دسته بندی', 'status' => 1],
            ['name' => 'دیدن دسته بندی', 'status' => 1],
            ['name' => 'حذف دسته بندی', 'status' => 1]
        ]);
    }
}
