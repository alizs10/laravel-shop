<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ایجاد نقش', 'status' => 1],
            ['name' => 'ویرایش نقش', 'status' => 1],
            ['name' => 'دیدن نقش', 'status' => 1],
            ['name' => 'حذف نقش', 'status' => 1]
        ]);
    }
}
