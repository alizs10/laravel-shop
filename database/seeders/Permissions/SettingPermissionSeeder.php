<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ویرایش تنظیمات', 'status' => 1],
            ['name' => 'دیدن تنظیمات', 'status' => 1]
        ]);
    }
}
