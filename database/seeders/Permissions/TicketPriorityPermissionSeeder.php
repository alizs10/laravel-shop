<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketPriorityPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'ایجاد اولویت بندی تیکت ها', 'status' => 1],
            ['name' => 'ویرایش اولویت بندی تیکت ها', 'status' => 1],
            ['name' => 'دیدن اولویت بندی تیکت ها', 'status' => 1],
            ['name' => 'حذف اولویت بندی تیکت ها', 'status' => 1]
        ]);
    }
}
