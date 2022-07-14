<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن دسته بندی محصول', 'status' => 1],
            ['name' => 'ایجاد دسته بندی محصول', 'status' => 1],
            ['name' => 'ویرایش دسته بندی محصول', 'status' => 1],
            ['name' => 'حذف دسته بندی محصول', 'status' => 1],
            ['name' => 'همه دسترسی ها (دسته بندی محصول)', 'status' => 1],
        ]);
    }
}
