<?php

namespace Database\Seeders\Permissions\Ticket;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن تیکت', 'status' => 1],
            ['name' => 'پاسخ به تیکت', 'status' => 1],
            ['name' => 'ویرایش تیکت', 'status' => 1],
            ['name' => 'حذف تیکت', 'status' => 1],
            ['name' => 'همه دسترسی ها(تیکت ها)', 'status' => 1],
        ]);
    }
}
