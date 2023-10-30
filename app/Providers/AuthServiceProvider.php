<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enums\Role;
use App\Models\User;
use App\Models\Review;
use App\Policies\ReviewPolicy;
use App\Gates\BookGates;
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
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    { 
        // we can define policies or individual gates as below
        
        //Gate::define('author', [BookGates::class, 'isAuthor']);
        //Gate::define('manage-review', [BookGates::class, 'manageReview']);
    
    }
}
