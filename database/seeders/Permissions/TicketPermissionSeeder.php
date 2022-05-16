<?php

namespace Database\Seeders\Permissions;

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
            ['name' => 'پاسخ به تیکت ها', 'status' => 1],
            ['name' => 'دیدن تیکت ها', 'status' => 1],
            ['name' => 'تغییر وضعیت تیکت ها', 'status' => 1]
        ]);
    }
}
