<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmazingSalePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن تخفیف شگفت انگیز', 'status' => 1],
            ['name' => 'ایجاد تخفیف شگفت انگیز', 'status' => 1],
            ['name' => 'ویرایش تخفیف شگفت انگیز', 'status' => 1],
            ['name' => 'حذف تخفیف شگفت انگیز', 'status' => 1],
            ['name' => 'همه دسترسی ها (تخفیف شگفت انگیز)', 'status' => 1],
        ]);
    }
}
