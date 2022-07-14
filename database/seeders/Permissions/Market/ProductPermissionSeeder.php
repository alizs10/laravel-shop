<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن محصول', 'status' => 1],
            ['name' => 'ایجاد محصول', 'status' => 1],
            ['name' => 'ویرایش محصول', 'status' => 1],
            ['name' => 'حذف محصول', 'status' => 1],
            ['name' => 'همه دسترسی ها (محصول)', 'status' => 1],
        ]);
    }
}
