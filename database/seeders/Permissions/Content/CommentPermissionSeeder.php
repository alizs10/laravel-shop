<?php

namespace Database\Seeders\Permissions\Content;

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
            ['name' => 'دیدن نظرات', 'status' => 1],
            ['name' => 'پاسخ به نظرات', 'status' => 1],
            ['name' => 'ویرایش نظرات', 'status' => 1],
            ['name' => 'حذف نظرات', 'status' => 1],
            ['name' => 'همه دسترسی ها (نظرات)', 'status' => 1],
        ]);
    }
}
