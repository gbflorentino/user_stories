<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use App\Models\Transaction;
use App\Policies\TransactionPolicy;

use App\Models\User;
use App\Policies\UserPolicy;

use App\Models\Category;
use App\Policies\CategoryPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
	Gate::policy(Transaction::class, TransactionPolicy::class);
	Gate::policy(Category::class, CategoryPolicy::class);
    }
}
