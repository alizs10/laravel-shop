<?php

namespace Database\Seeders\Permissions\Market;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicDiscountPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'دیدن تخفیف عمومی', 'status' => 1],
            ['name' => 'ایجاد تخفیف عمومی', 'status' => 1],
            ['name' => 'ویرایش تخفیف عمومی', 'status' => 1],
            ['name' => 'حذف تخفیف عمومی', 'status' => 1],
            ['name' => 'همه دسترسی ها (تخفیف عمومی)', 'status' => 1],
        ]);
    }
}
