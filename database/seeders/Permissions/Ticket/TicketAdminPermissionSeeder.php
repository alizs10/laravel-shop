<?php

namespace Database\Seeders\Permissions\Ticket;

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
            ['name' => 'دیدن ادمین تیکت ها', 'status' => 1],
            ['name' => 'افزودن ادمین تیکت ها', 'status' => 1],
            ['name' => 'ویرایش ادمین تیکت ها', 'status' => 1],
            ['name' => 'حذف ادمین تیکت ها', 'status' => 1],
            ['name' => 'همه دسترسی ها (ادمین تیکت ها)', 'status' => 1]
        ]);
    }
}
