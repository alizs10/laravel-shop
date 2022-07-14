<?php

namespace Database\Seeders;

use Database\Seeders\Permissions\Content\AdvertisementBanerPermissionSeeder;
use Database\Seeders\Permissions\Content\CommentPermissionSeeder;
use Database\Seeders\Permissions\Content\FAQPermissionSeeder;
use Database\Seeders\Permissions\Content\MenuPermissionSeeder;
use Database\Seeders\Permissions\Content\PagePermissionSeeder;
use Database\Seeders\Permissions\Content\PostCategoryPermissionSeeder;
use Database\Seeders\Permissions\Content\PostPermissionSeeder;
use Database\Seeders\Permissions\Market\AmazingSalePermissionSeeder;
use Database\Seeders\Permissions\Market\BrandPermissionSeeder;
use Database\Seeders\Permissions\Market\CouponPermissionSeeder;
use Database\Seeders\Permissions\Market\PublicDiscountPermissionSeeder;
use Database\Seeders\Permissions\Market\DeliveryPermissionSeeder;
use Database\Seeders\Permissions\Market\OrderPermissionSeeder;
use Database\Seeders\Permissions\Market\PaymentPermissionSeeder;
use Database\Seeders\Permissions\Market\ProductCategoryPermissionSeeder;
use Database\Seeders\Permissions\Market\ProductPermissionSeeder;
use Database\Seeders\Permissions\Notify\EmailFilePermissionSeeder;
use Database\Seeders\Permissions\Notify\EmailPermissionSeeder;
use Database\Seeders\Permissions\Notify\SMSPermissionSeeder;

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
            //market
            // DeliveryPermissionSeeder::class,

            // CouponPermissionSeeder::class,
            // AmazingSalePermissionSeeder::class,
            // PublicDiscountPermissionSeeder::class,

            // PaymentPermissionSeeder::class,
            // OrderPermissionSeederk::class,

            // ProductCategoryPermissionSeeder::class,
            // ProductPermissionSeeder::class,
            // BrandPermissionSeeder::class,
            

            //content
            // PostCategoryPermissionSeeder::class,
            // PostPermissionSeeder::class,
            // FAQPermissionSeeder::class,
            // MenuPermissionSeeder::class,
            // PagePermissionSeeder::class,
            // CommentPermissionSeeder::class,
            // AdvertisementBanerPermissionSeeder::class,

            //user
            // RolePermissionSeeder::class,
            // UserPermissionSeeder::class,

            //tickets
            // TicketPermissionSeeder::class,
            // TicketAdminPermissionSeeder::class,
            // TicketPriorityPermissionSeeder::class,
            // TicketCategoryPermissionSeeder::class,

            //notify
            // EmailPermissionSeeder::class,
            // EmailFilePermissionSeeder::class,
            // SMSPermissionSeeder::class,

            //setting
            // SettingPermissionSeeder::class,
        ]);
    }
}
