<?php

namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'پاسخ به نظرات', 'status' => 1],
            ['name' => 'دیدن نظرات', 'status' => 1],
            ['name' => 'حذف نظرات', 'status' => 1]
        ]);
    }
}
