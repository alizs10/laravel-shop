<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'اضافه کردن ادمین تیکت ها', 'status' => 1],
            ['name' => 'دیدن ادمین تیکت ها', 'status' => 1],
            ['name' => 'حذف ادمین تیکت ها', 'status' => 1]
        ]);
    }
}
