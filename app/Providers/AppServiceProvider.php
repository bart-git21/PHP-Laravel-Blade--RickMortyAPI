<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

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
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        DB::listen(function (QueryExecuted $query) {
            try {
                if ($query->time > 1000) {
                    Log::channel('sql_error_channel')->warning("Slow sql query: $query->time.");
                    Log::channel('sql_error_channel')->error('bindings: ' . json_encode($query->bindings));
                }
            } catch(\Exception $e) {
                Log::channel('sql_error_channel')->error('SQL error: '. $e->getMessage());
            }
        });
    }
}
