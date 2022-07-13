<?php

namespace Database\Seeders;

use Database\Seeders\Permissions\CommentPermissionSeeder;

use Database\Seeders\Permissions\FAQPermissionSeeder;
use Database\Seeders\Permissions\MenuPermissionSeeder;
use Database\Seeders\Permissions\Notify\EmailFilePermissionSeeder;
use Database\Seeders\Permissions\Notify\EmailPermissionSeeder;
use Database\Seeders\Permissions\Notify\SMSPermissionSeeder;
use Database\Seeders\Permissions\PagePermissionSeeder;
use Database\Seeders\Permissions\PostCategoryPermissionSeeder;
use Database\Seeders\Permissions\PostPermissionSeeder;
use Database\Seeders\Permissions\RolePermissionSeeder;
use Database\Seeders\Permissions\SettingPermissionSeeder;
use Database\Seeders\Permissions\Ticket\TicketAdminPermissionSeeder;
use Database\Seeders\Permissions\Ticket\TicketCategoryPermissionSeeder;
use Database\Seeders\Permissions\Ticket\TicketPermissionSeeder;
use Database\Seeders\Permissions\Ticket\TicketPriorityPermissionSeeder;
use Database\Seeders\Permissions\UserPermissionSeeder;
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
            // RolePermissionSeeder::class,
            // UserPermissionSeeder::class,
            // TicketPermissionSeeder::class,
            // TicketAdminPermissionSeeder::class,
            // TicketPriorityPermissionSeeder::class,
            // TicketCategoryPermissionSeeder::class,
            // EmailPermissionSeeder::class,
            // EmailFilePermissionSeeder::class,
            // SMSPermissionSeeder::class,
            // SettingPermissionSeeder::class,
        ]);
    }
}
