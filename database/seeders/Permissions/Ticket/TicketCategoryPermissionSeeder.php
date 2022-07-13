<?php

namespace Database\Seeders\Permissions\Ticket;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketCategoryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن دسته بندی تیکت ها', 'status' => 1],
            ['name' => 'ایجاد دسته بندی تیکت ها', 'status' => 1],
            ['name' => 'ویرایش دسته بندی تیکت ها', 'status' => 1],
            ['name' => 'حذف دسته بندی تیکت ها', 'status' => 1],
            ['name' => 'همه دسترسی ها (دسته بندی تیکت ها)', 'status' => 1],
        ]);
    }
}
