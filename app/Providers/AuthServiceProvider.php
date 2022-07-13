<?php

namespace App\Providers;

use App\Models\Content\Post;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use App\Models\Notify\SMS;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use App\Models\User;
use App\Models\User\Role;
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
        Email::class => EmailPolicy::class,
        EmailFile::class => EmailFilePolicy::class,
        SMS::class => SMSPolicy::class,
        Ticket::class => TicketPolicy::class,
        TicketAdmin::class => TicketAdminPolicy::class,
        TicketPriority::class => TicketPriorityPolicy::class,
        TicketCategory::class => TicketCategoryPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        
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
