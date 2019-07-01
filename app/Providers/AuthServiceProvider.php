<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\User;
use App\Evaluation;
use App\EvaluationUser;
use App\Question;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-evaluation-user', function (User $user, Evaluation $evaluation) {

            if ( $user->isAdmin() ) {
                return true;
            }

            // user is evaluator of this evaluation?
            if ( $user->isEvaluator() ) {
                return $evaluation->user_id == $user->id;
            }

            $count = EvaluationUser::where('user_id', $user->id)
                        ->where('evaluation_id', $evaluation->id)
                        ->count();
            return $count > 0 ? true : false;
        });

    }
}
