<?php

namespace Database\Seeders;

use Database\Seeders\Permissions\CommentPermissionSeeder;
use Database\Seeders\Permissions\EmailPermissionSeeder;
use Database\Seeders\Permissions\FAQPermissionSeeder;
use Database\Seeders\Permissions\MenuPermissionSeeder;
use Database\Seeders\Permissions\PagePermissionSeeder;
use Database\Seeders\Permissions\PostCategoryPermissionSeeder;
use Database\Seeders\Permissions\PostPermissionSeeder;
use Database\Seeders\Permissions\SettingPermissionSeeder;
use Database\Seeders\Permissions\SMSPermissionSeeder;
use Database\Seeders\Permissions\TicketAdminPermissionSeeder;
use Database\Seeders\Permissions\TicketCategoryPermissionSeeder;
use Database\Seeders\Permissions\TicketPermissionSeeder;
use Database\Seeders\Permissions\TicketPriorityPermissionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // PostPermissionSeeder::class,
            // PostCategoryPermissionSeeder::class,
            // FAQPermissionSeeder::class,
            // MenuPermissionSeeder::class,
            // PagePermissionSeeder::class,
            // CommentPermissionSeeder::class,
            // TicketPermissionSeeder::class,
            // TicketAdminPermissionSeeder::class,
            // TicketCategoryPermissionSeeder::class,
            // TicketPriorityPermissionSeeder::class,
            // EmailPermissionSeeder::class,
            // SMSPermissionSeeder::class,
            // SettingPermissionSeeder::class,
        ]);
    }
}
