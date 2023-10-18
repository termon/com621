<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Review;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        //Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    { 
        // we can define policies or individual gates as below
        // Gate::define('owns-review', function (User $user,Review $review) {
        //     return $user->id === $review->user_id;
        // });
    }
}
