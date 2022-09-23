<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      $this->registerPolicies();

      // ホーム長・運営のみ許可
      Gate::define('admin-only', function ($user) {
        return ($user->role_id == 1);
      });
      // 看護職員に許可
      Gate::define('nurse-higher', function ($user) {
        return ($user->role_id <= 3);
      });
      // 全権限に許可
      Gate::define('all', function ($user) {
        //return ($user->role_id <= 4);
      });
    }
}
