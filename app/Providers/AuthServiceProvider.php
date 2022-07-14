<?php

namespace App\Providers;

use App\Models\Content\AdvertisementBaner;
use App\Models\Content\Faq;
use App\Models\Content\Page;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use App\Models\Market\AmazingSale;
use App\Models\Market\Brand;
use App\Models\Market\Coupon;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\PublicDiscount;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use App\Models\Notify\SMS;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use App\Models\User;
use App\Models\User\Role;
use App\Policies\Content\AdvertisementBanerPolicy;
use App\Policies\Content\CommentPolicy;
use App\Policies\Content\FaqPolicy;
use App\Policies\Content\PagePolicy;
use App\Policies\Content\PostCategoryPolicy;
use App\Policies\Content\PostPolicy;
use App\Policies\Market\AmazingSalePolicy;
use App\Policies\Market\BrandPolicy;
use App\Policies\Market\CouponPolicy;
use App\Policies\Market\DeliveryPolicy;
use App\Policies\Market\OrderPolicy;
use App\Policies\Market\PaymentPolicy;
use App\Policies\Market\ProductCategoryPolicy;
use App\Policies\Market\ProductPolicy;
use App\Policies\Market\PublicDiscountPolicy;
use App\Policies\Notify\EmailFilePolicy;
use App\Policies\Notify\EmailPolicy;
use App\Policies\Notify\SMSPolicy;
use App\Policies\Ticket\TicketAdminPolicy;
use App\Policies\Ticket\TicketCategoryPolicy;
use App\Policies\Ticket\TicketPolicy;
use App\Policies\Ticket\TicketPriorityPolicy;
use App\Policies\User\RolePolicy;
use App\Policies\User\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        //notify
        Email::class => EmailPolicy::class,
        EmailFile::class => EmailFilePolicy::class,
        SMS::class => SMSPolicy::class,
        
        //tickets
        Ticket::class => TicketPolicy::class,
        TicketAdmin::class => TicketAdminPolicy::class,
        TicketPriority::class => TicketPriorityPolicy::class,
        TicketCategory::class => TicketCategoryPolicy::class,
        
        //user
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        
        //content
        PostCategory::class => PostCategoryPolicy::class,
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        AdvertisementBaner::class => AdvertisementBanerPolicy::class,
        Faq::class => FaqPolicy::class,
        Page::class => PagePolicy::class,

        //market
        Delivery::class => DeliveryPolicy::class,
        Coupon::class => CouponPolicy::class,
        PublicDiscount::class => PublicDiscountPolicy::class,
        AmazingSale::class => AmazingSalePolicy::class,
        Payment::class => PaymentPolicy::class,
        Order::class => OrderPolicy::class,
        Product::class => ProductPolicy::class,
        ProductCategory::class => ProductCategoryPolicy::class,
        Brand::class => BrandPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
    }
}
